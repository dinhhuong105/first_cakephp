<?php

/**
 * /AdminAppController
 */

namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Cache\Cache;

/**
 * AdminAppController
 *
 * @since 1.0
 * @version 1.0
 * @author Dinh Van Huong
 */
class AdminAppController extends AppController
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();
        $this->viewBuilder()->layout('admin_template');
        
        // re-config pagination.
        $this->paginate = [
            'limit' => TOTAL_RECORD_DISPLAYED
        ];

        $this->loadComponent('Auth', [
            'authorize'    => 'Controller',
            'authenticate'   => [
                'Form' => [
                    'userModel' => 'Accounts'
                ]
            ],
            'loginAction'    => [
                'controller' => 'Accounts',
                'action'     => 'login'
            ],
            'logoutRedirect' => [
                'controller' => 'Accounts',
                'action'     => 'login'
            ],
            'storage'        => 'Session'
        ]);
    }
    
    public function isAuthorized($user)
    {
        $allowCtr = ['home', 'errors'];
        if (in_array(strtolower($this->request->params['controller']), $allowCtr)) {
            return $this->redirect(['controller' => 'Errors', 'action' => 'error401']);
        }
        
        $accPerms = Cache::read('acc_permissions_' . $user['username'], 'permissions');
        if ($accPerms === false) {
            $this->setCachePermissions($user);
            $accPerms = Cache::read('acc_permissions_' . $user['username'], 'permissions');
        }       

        foreach ($accPerms as $controller => $perm) {
            if (strtolower($controller) != strtolower($this->request->params['controller'])) {
                continue;
            }
            
            if ($perm == 'all') {
                return true;
            }
            
            if (in_array($this->request->params['action'], $perm)) {
                return true;
            }
            
            $this->Flash->error(__('permission_deny'));
            return false;
        }
        
        return false;
        
    }

    
    /**
     * set cache permissions for user
     * 
     * @param array $user
     * @return mixed
     * 
     * @since 1.0
     * @version 1.0
     * @author Dinh Van Huong
     */
    public function setCachePermissions($user)
    {
        $groups = $this->loadModel('AccountsGroups')->get($user['group_id'], ['contain' => ['AccountsPermissions']]);
        if (empty($groups->accounts_permissions)) {
            return $this->redirect(['controller' => 'Errors', 'action' => 'error401']);
        }

        $perms = [];
        foreach ($groups->accounts_permissions as $permissions) {
            if ($permissions->_joinData->full_actions) {
                $perms[$permissions->controller] = 'all';
            } else {
                $perms[$permissions->controller] = unserialize($permissions->_joinData->actions);
            }
        }

        Cache::write('acc_permissions_' . $user['username'], $perms, 'permissions');
    }
}

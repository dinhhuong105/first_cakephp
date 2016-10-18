<?php

/**
 * /AccountsController.php
 */

namespace App\Controller\Admin;

/**
 * AccountsController
 *
 * @since 1.0
 * @version 1.0
 * @author Dinh Van Huong
 */
class AccountsController extends AdminAppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Files');
    }
    
    public function authorize($user)
    {
        echo "<pre>";
        print_r($user);
        echo "</pre>";
        exit;
    }

    /**
     * display list account in view
     *
     * @return void
     *
     * @since 1.0
     * @version 1.0
     * @author Dinh Van Huong
     */
    public function index()
    {
        // re-config pagination.
        $this->paginate = [
            'contain'   =>  ['AccountsGroups']
        ];
        
        if ($this->request->is('post')) {
            if (empty($this->request->data['ids'])) {
                $this->Flash->error(__('not_check_item'));
                return $this->redirect(['action' => 'index']);
            }
            
            if (isset($this->request->data['delete-all']) && $this->Accounts->deleteAll($this->request->data['ids'])) {
                $this->Flash->success(__('delete_success'));
            } else {
                $this->Flash->error(__('delete_fail'));
            }
                
            return $this->redirect(['action' => 'index']);
        }
        
        $page  = (isset($this->request->params['page'])) ? $this->request->params['page'] : 1;
        $datas = $this->paginate($this->Accounts, ['page' => $page]);

        $this->set(compact('datas'));
        $this->set('_serialize', ['datas']);
        $this->set('title', __('accounts'));
    }

    /**
     * add new account
     *
     * @return void
     *
     * @since 1.0
     * @version 1.0
     * @author Dinh Van Huong
     */
    public function add()
    {
        $accounts = $this->Accounts->newEntity();
        if ($this->request->is('post')) {
            
            $this->request->data['active']      = 1;
            $this->request->data['created_at']  = time();
            $this->request->data['updated_at']  = time();
            
            if ($this->request->data['avatar']) {
                $avatar = $this->Files->upload($this->request->data['avatar'], 'uploads/pictures/', true, 350, 350);
            }
            
            if (isset($avatar['name'])) {
                $this->request->data['avatar'] = $avatar['name'];
            }
            
            $accounts = $this->Accounts->patchEntity($accounts, $this->request->data());
            if ($this->Accounts->save($accounts)) {
                $this->Flash->success(__('add_success'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('add_fail'));
            }
        }
        
        $groups = $this->loadModel('AccountsGroups')->find('list', ['keyField' => 'id', 'valueField' => 'name'])->toArray();
        $this->set(compact('accounts'), $accounts);
        $this->set('_serialize', ['accounts']);
        $this->set('groups', $groups);
        $this->set('title', __('add_new {0}', __('accounts')));
    }

    /**
     * edit account
     *
     * @param int $id account ID
     * @return void
     *
     * @since 1.0
     * @version 1.0
     * @author Dinh Van Huong
     */
    public function edit($id)
    {
        if (empty($id)) {
            $this->Flash->error(__('id_not_found'));
            return $this->redirect(['action' => 'index']);
        }
        
        $accounts = $this->Accounts->get($id, ['contain' => ['AccountsGroups']]);
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            
            $this->request->data['updated_at']  = time();
            if (empty($this->request->data['password'])) {
                unset($this->request->data['password']);
            }
            
            if ($this->request->data['avatar']) {
                $avatar = $this->Files->upload($this->request->data['avatar'], 'uploads/pictures/', true, 350, 350);
            }
            
            if (isset($avatar['name'])) {
                $this->request->data['avatar'] = $avatar['name'];
            } else {
                if ($this->request->data['remove_feature_image']) {
                    $this->request->data['avatar'] = '';
                } else {
                    unset($this->request->data['avatar']);
                }
            }
            
            $accounts = $this->Accounts->patchEntity($accounts, $this->request->data());
            if ($this->Accounts->save($accounts)) {
                $this->Flash->success(__('add_success'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('add_fail'));
            }
        }
        
        $this->set(compact('accounts'), $accounts);
        $this->set('_serialize', 'accounts');
        $this->set('groups', $this->loadModel('AccountsGroups')->find('list', ['keyField' => 'id', 'valueField' => 'name'])->toArray());
        $this->set('title', __('edit {0}', __('accounts')));
    }

    /**
     * delete account
     *
     * @param int $id account ID
     * @return void
     *
     * @since 1.0
     * @version 1.0
     * @author Dinh Van Huong
     */
    public function delete($id)
    {
        if (empty($id)) {
            $this->Flash->error(__('id_not_found'));
            return $this->redirect(['action' => 'index']);
        }
        
        $accounts = $this->Accounts->get($id);

        if ($this->Accounts->delete($accounts)) {
            $this->Flash->success(__('delete_success'));
        } else {
            $this->Flash->error(__('delete_fail'));
        }
        
        return $this->redirect(['action' => 'index']);
    }

    /**
     * accounts groups
     *
     * @return void
     *
     * @since 1.0
     * @version 1.0
     * @author Dinh Van Huong
     */
    public function accountsGroups()
    {
        $this->redirect(['controller' => 'AccountsGroups', 'action' => 'index']);
    }

    /**
     * accounts permissions
     *
     * @return void
     *
     * @since 1.0
     * @version 1.0
     * @author Dinh Van Huong
     */
    public function accountsPermissions()
    {
        $this->redirect(['controller' => 'AccountsPermissions', 'action' => 'index']);
    }

    /**
     * login
     *
     * @return void
     *
     * @since 1.0
     * @version 1.0
     * @author Dinh Van Huong
     */
    public function login()
    {
        
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                $this->Flash->success(__('welcome_to_admin_panel'));
                
                /* update last login for account */
                $account = $this->Accounts->get($user['id']);
                $account->last_login = time();
                $this->Accounts->save($account);
                return $this->redirect(['controller' => 'Posts', 'action' => 'index']);
            }
            $this->Flash->error(__('invalid_login'));
        }
    }

    /**
     * logout
     *
     * @return void
     *
     * @since 1.0
     * @version 1.0
     * @author Dinh Van Huong
     */
    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }

}

<?php

/**
 * /AdminAppController
 */

namespace App\Controller\Admin;

use App\Controller\AppController;

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
            //'authorize'    => 'Controller',
            'authenticate'   => [
                'Form' => [
                    'userModel' => 'Accounts'
                ]
            ],
            'loginAction'    => [
                'controller' => 'Accounts',
                'action'     => 'login'
            ],
            'loginRedirect'  => [
                'controller' => 'Accounts',
                'action'     => 'index'
            ],
            'logoutRedirect' => [
                'controller' => 'Accounts',
                'action'     => 'login'
            ],
            'storage'        => 'Session'
        ]);
    }

}

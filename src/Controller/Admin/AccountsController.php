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
            'limit' => TOTAL_RECORD_DISPLAYED
        ];

        $page  = (isset($this->request->params['page'])) ? $this->request->params['page'] : 1;
        $datas = $this->paginate($this->AccountsGroups, ['page' => $page]);

        $this->set(compact('datas'));
        $this->set('_serialize', ['datas']);
        $this->set('title', __('Accounts Groups'));
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
        $accountGroup = $this->AccountsGroups->newEntity();
        if ($this->request->is('post')) {
            $data = $this->request->data;

            $accountGroup->name       = $data['name'];
            $accountGroup->created_at = time();
            $accountGroup->updated_at = time();

            if ($this->AccountsGroups->save($accountGroup)) {
                $this->Flash->success(__('The account group has been saved.'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The account group could not be saved. Please, try again.'));
            }
        }

        $this->set(compact('accountGroup'), $accountGroup);
        $this->set('_serialize', ['accountGroup']);
        $this->set('title', __('Add new'));
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
        $user = ['id' => 1, 'username' => 'admin'];
        $this->Auth->setUser($user);
        return $this->redirect(['controller' => 'Posts', 'action' => 'index']);
        /*
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('Invalid username or password, try again'));
        }
        */
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

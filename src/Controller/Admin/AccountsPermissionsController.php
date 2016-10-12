<?php
/**
 * /AccountsPermissionsController.php
 */
namespace App\Controller\Admin;

/**
 * AccountsPermissionsController
 *
 * @since 1.0
 * @version 1.0
 * @author Dinh Van Huong
 */
class AccountsPermissionsController extends AdminAppController
{

    /**
     * display list account permission in view
	 * 
	 * @return void
     *
     * @since 1.0
	 * @version 1.0
	 * @author Dinh Van Huong
     */
    public function index()
    {
        if ($this->request->is('post')) {
            if (empty($this->request->data['ids'])) {
                $this->Flash->error(__('not_check_item'));
                return $this->redirect(['action' => 'index']);
            }
            
            if (isset($this->request->data['delete-all']) && $this->AccountsPermissions->deleteAll($this->request->data['ids'])) {
                $this->Flash->success(__('delete_success'));
            } else {
                $this->Flash->error(__('delete_fail'));
            }
                
            return $this->redirect(['action' => 'index']);
        }
        
        $page	= (isset($this->request->params['page'])) ? $this->request->params['page'] : 1;
        $datas  = $this->paginate($this->AccountsPermissions, ['page' => $page]);

        $this->set(compact('datas'));
        $this->set('_serialize', ['datas']);
		$this->set('title', __('accounts_permissions'));
    }
	
	/**
	 * add new account permissions
	 * 
	 * @return void
	 * 
	 * @since 1.0
	 * @version 1.0
	 * @author Dinh Van Huong
	 */
	public function add()
	{
		$accountPermission = $this->AccountsPermissions->newEntity();
		if ($this->request->is('post')) {
            $accountPermission = $this->AccountsPermissions->patchEntity($accountPermission, $this->request->data());
            if ($this->AccountsPermissions->save($accountPermission)) {
                $this->Flash->success(__('add_success'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('add_fail'));
            }
		}
		
		$this->set(compact('accountPermission'), $accountPermission);
        $this->set('_serialize', ['accountPermission']);
		$this->set('title', __('add_new {0}', __('accounts_permissions')));
	}
	
	/**
	 * edit account group
	 * 
	 * @param int $id group ID
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

        $accountPermission = $this->AccountsPermissions->get($id);
		if ($this->request->is(['patch', 'put', 'post'])) {
            $accountPermission = $this->AccountsPermissions->patchEntity($accountPermission, $this->request->data());
            if ($this->AccountsPermissions->save($accountPermission)) {
                $this->Flash->success(__('update_success'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('update_fail'));
            }
		}
        
		$this->set(compact('accountPermission'), $accountPermission);
        $this->set('_serialize', ['accountPermission']);
		$this->set('title', __('edit {0}', __('accounts_permissions')));
	}
	
	/**
	 * delete account group
	 * 
	 * @param int $id group ID
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
        
        $permission = $this->AccountsPermissions->get($id);
        if ($this->AccountsPermissions->delete($permission)) {
            $this->Flash->success(__('delete_success'));
        } else {
            $this->Flash->error(__('delete_fail'));
        }
        
        return $this->redirect(['action' => 'index']);
	}
    /*
    private function deleteAll($ids)
    {
        $this->AccountsPermissions->connection()->transactional(function () {
            foreach ($ids as $id) {
                echo $id;exit;
                $this->delete($id);
            }
        });
    }
    */
}

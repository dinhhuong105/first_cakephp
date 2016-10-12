<?php
/**
 * /AccountsGroupsController.php
 */
namespace App\Controller\Admin;

/**
 * AccountsGroupsController
 *
 * @since 1.0
 * @version 1.0
 * @author Dinh Van Huong
 */
class AccountsGroupsController extends AdminAppController
{

    /**
     * display list account group in view
	 * 
	 * @return void
     *
     * @since 1.0
	 * @version 1.0
	 * @author Dinh Van Huong
     */
    public function index()
    {
        $page	= (isset($this->request->params['page'])) ? $this->request->params['page'] : 1;
        $datas  = $this->paginate($this->AccountsGroups, ['page' => $page]);

        $this->set(compact('datas'));
        $this->set('_serialize', ['datas']);
		$this->set('title', __('Accounts Groups'));
    }
	
	/**
	 * add new account group
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
            if ($this->AccountsGroups->save($accountGroup)) {
                $this->Flash->success(__('add_success'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('add_fail'));
            }
		}

        $this->set('permissions', $this->loadModel('AccountsPermissions')->find('all'));
		$this->set(compact('accountGroup'), $accountGroup);
        $this->set('_serialize', ['accountGroup']);
		$this->set('title', __('add_new {0}', __('accounts_groups')));
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
		
	}
}

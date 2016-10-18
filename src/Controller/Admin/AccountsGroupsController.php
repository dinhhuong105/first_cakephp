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
        if ($this->request->is('post')) {
            if (empty($this->request->data['ids'])) {
                $this->Flash->error(__('not_check_item'));
                return $this->redirect(['action' => 'index']);
            }
            
            if (isset($this->request->data['delete-all']) && $this->AccountsGroups->deleteAll($this->request->data['ids'])) {
                $this->Flash->success(__('delete_success'));
            } else {
                $this->Flash->error(__('delete_fail'));
            }
                
            return $this->redirect(['action' => 'index']);
        }
        
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
			$inputData = $this->request->data;
            $data['name']       = $inputData['name'];
            $data['created_at'] = time();
            $data['updated_at'] = time();
                        
            /* insert data to relationship tables */
            if (isset($inputData['perms'])) {
                $i = 0;
                foreach ($inputData['perms'] as $perms_id => $perms_actions) {
                    if (!isset($perms_actions['actions']) && empty($perms_actions['full_actions'])) {
                        continue;
                    }
                    
                    $data['accounts_permissions'][$i]['id'] = $perms_id;
                    $data['accounts_permissions'][$i]['_joinData']['full_actions'] = $perms_actions['full_actions'];
                    
                    if (isset($perms_actions['actions'])) {
                        $data['accounts_permissions'][$i]['_joinData']['actions'] = serialize($perms_actions['actions']);
                    }
                    
                    $i++;
                }
            }
            
            $accountGroup = $this->AccountsGroups->patchEntity($accountGroup, $data);
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
        if (empty($id)) {
            $this->Flash->error(__('id_not_found'));
            return $this->redirect(['action' => 'index']);
        }
        
		$accountGroup = $this->AccountsGroups->get($id, [
            'contain' => ['AccountsPermissions']
        ]);
        
        if ($this->request->is(['patch', 'post', 'put'])) {
			$inputData = $this->request->data;
            
            $data['name']       = $inputData['name'];
            $data['updated_at'] = time();
            
            /* insert data to relationship tables */
            if (isset($inputData['perms'])) {
                $i = 0;
                foreach ($inputData['perms'] as $perms_id => $perms_actions) {
                    
                    if (!isset($perms_actions['actions']) && empty($perms_actions['full_actions'])) {
                        continue;
                    }
                    
                    $data['accounts_permissions'][$i]['id']                     = $perms_id;
                    $data['accounts_permissions'][$i]['_joinData']['perms_id']  = $perms_id;
                    $data['accounts_permissions'][$i]['_joinData']['group_id']  = $id;
                    $data['accounts_permissions'][$i]['_joinData']['full_actions'] = $perms_actions['full_actions'];
                    if (isset($perms_actions['actions'])) {
                        $data['accounts_permissions'][$i]['_joinData']['actions'] = serialize($perms_actions['actions']);
                    }
                    $i++;
                }
            } else {
                $data['accounts_permissions'] = [];
            }
            
            $accountGroup = $this->AccountsGroups->patchEntity($accountGroup, $data);
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
		$this->set('title', __('edit {0}', __('accounts_groups')));
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
        
        $tag = $this->AccountsGroups->get($id);

        if ($this->AccountsGroups->delete($tag)) {
            $this->Flash->success(__('delete_success'));
        } else {
            $this->Flash->error(__('delete_fail'));
        }
        
        return $this->redirect(['action' => 'index']);
	}
}

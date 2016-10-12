<?php
/**
 * /CategoriesController.php
 */
namespace App\Controller\Admin;

use Cake\Utility\Text;

/**
 * CategoriesController
 *
 * @since 1.0
 * @version 1.0
 * @author Dinh Van Huong
 */
class CategoriesController extends AdminAppController
{

    /**
     * display list categories
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
            
            if (isset($this->request->data['delete-all']) && $this->Categories->deleteAll($this->request->data['ids'])) {
                $this->Flash->success(__('delete_success'));
            } else {
                $this->Flash->error(__('delete_fail'));
            }

            return $this->redirect(['action' => 'index']);
        }
        
        $page	= (isset($this->request->params['page'])) ? $this->request->params['page'] : 1;
        $datas  = $this->paginate($this->Categories, ['page' => $page]);
				
        $this->set(compact('datas'));
        $this->set('_serialize', ['datas']);
		$this->set('title', __('categories'));
    }
	
	/**
	 * add new category
	 * 
	 * @return void
	 * 
	 * @since 1.0
	 * @version 1.0
	 * @author Dinh Van Huong
	 */
	public function add()
	{
		$categories = $this->Categories->newEntity();
		if ($this->request->is('post')) {
			$data   = $this->request->data;
            $alias  = ($data['alias']) ? $data['alias'] : $data['name'];
			$categories->name           = $data['name'];
            $categories->alias          = Text::slug(strtolower($alias));
            $categories->meta_title     = ($data['meta_title']) ? $data['meta_title'] : $data['name'];
            $categories->meta_keyword   = ($data['meta_keyword']) ? $data['meta_keyword'] : $data['name'];
            $categories->meta_desc      = ($data['meta_desc']) ? $data['meta_desc'] : $data['name'];
			$categories->created_at     = time();
			$categories->updated_at     = time();
            
            if ($this->Categories->save($categories)) {
                $this->Flash->success(__('add_success'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('add_fail'));
            }
		}
		
		$this->set(compact('categories'), $categories);
        $this->set('_serialize', ['categories']);
		$this->set('title', __('add_new {0}', __('categories')));
	}
	
	/**
	 * edit category
	 * 
	 * @param int $id category ID
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
        
		$categories = $this->Categories->get($id);
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            // prepare data.
            $data   = $this->request->data;
            $alias  = ($data['alias']) ? $data['alias'] : $data['name'];
            
            $categories->name           = trim($data['name']);
            $categories->alias          = Text::slug(strtolower($alias));
            $categories->meta_title     = ($data['meta_title']) ? $data['meta_title'] : $data['name'];
            $categories->meta_keyword   = ($data['meta_keyword']) ? $data['meta_keyword'] : $data['name'];
            $categories->meta_desc      = ($data['meta_desc']) ? $data['meta_desc'] : $data['name'];
			$categories->updated_at     = time();
            
            if ($this->Categories->save($categories)) {                
                $this->Flash->success(__('update_success'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('update_fail'));
            }
        }
        
        $this->set(compact('categories'), $categories);
        $this->set('_serialize', ['categories']);
		$this->set('title', __('edit {0}', __('categories')));
	}
	
	/**
	 * delete category
	 * 
	 * @param int $id category ID
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
        
		$category = $this->Categories->get($id);
        if ($this->Categories->delete($category)) {
            $this->Flash->success(__('delete_success'));
        } else {
            $this->Flash->error(__('delete_fail'));
        }
        
        return $this->redirect(['action' => 'index']);
	}
}

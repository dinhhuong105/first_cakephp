<?php

/**
 * /TagsController.php
 */

namespace App\Controller\Admin;

use Cake\Utility\Text;

/**
 * TagsController
 *
 * @since 1.0
 * @version 1.0
 * @author Dinh Van Huong
 */
class TagsController extends AdminAppController
{

    /**
     * initialize
     */
    public function initialize()
    {
        parent::initialize();
    }

    /**
     * display list tags
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
            
            if (isset($this->request->data['delete-all']) && $this->Tags->deleteAll($this->request->data['ids'])) {
                $this->Flash->success(__('delete_success'));
            } else {
                $this->Flash->error(__('delete_fail'));
            }
                
            return $this->redirect(['action' => 'index']);
        }
        $page  = (isset($this->request->params['page'])) ? $this->request->params['page'] : 1;
        $datas = $this->paginate($this->Tags, ['page' => $page]);

        $this->set(compact('datas'));
        $this->set('_serialize', ['datas']);
        $this->set('title', __('tags'));
    }

    /**
     * add new tag
     *
     * @return void
     *
     * @since 1.0
     * @version 1.0
     * @author Dinh Van Huong
     */
    public function add()
    {
        $tags = $this->Tags->newEntity();
        if ($this->request->is('post')) {
            $data   = $this->request->data;
            $alias  = ($data['alias']) ? $data['alias'] : $data['name'];
			$tags->name           = $data['name'];
            $tags->alias          = Text::slug(strtolower($alias));
            $tags->meta_title     = ($data['meta_title']) ? $data['meta_title'] : $data['name'];
            $tags->meta_keyword   = ($data['meta_keyword']) ? $data['meta_keyword'] : $data['name'];
            $tags->meta_desc      = ($data['meta_desc']) ? $data['meta_desc'] : $data['name'];
			$tags->created_at     = time();
			$tags->updated_at     = time();

            if ($this->Tags->save($tags)) {
                $this->Flash->success(__('add_success'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('add_fail'));
            }
        }

        $this->set(compact('tags'), $tags);
        $this->set('_serialize', ['tags']);
        $this->set('title', __('add_new {0}', __('tags')));
    }

    /**
     * edit tag
     *
     * @param int $id tag ID
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

        $tags = $this->Tags->get($id);
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            // prepare data.
            $data   = $this->request->data;
            $alias  = ($data['alias']) ? $data['alias'] : $data['name'];
            
            $tags->name           = trim(h($data['name']));
            $tags->alias          = Text::slug(strtolower($alias));
            $tags->meta_title     = ($data['meta_title']) ? $data['meta_title'] : $data['name'];
            $tags->meta_keyword   = ($data['meta_keyword']) ? $data['meta_keyword'] : $data['name'];
            $tags->meta_desc      = ($data['meta_desc']) ? $data['meta_desc'] : $data['name'];
			$tags->updated_at     = time();
            
            if ($this->Tags->save($tags)) {                
                $this->Flash->success(__('update_success'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('update_fail'));
            }
        }
        
        $this->set(compact('tags'), $tags);
        $this->set('_serialize', ['tags']);
        $this->set('title', __('edit {0}', __('tags')));
    }

    /**
     * delete tag
     *
     * @param int $id tag ID
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
        
        $tag = $this->Tags->get($id);

        if ($this->Tags->delete($tag)) {
            $this->Flash->success(__('delete_success'));
        } else {
            $this->Flash->error(__('delete_fail'));
        }
        
        return $this->redirect(['action' => 'index']);
    }

    public function getListTagsName()
    {
        $data = $this->Tags->getListTagsName();
        $this->set('data', $data);
        $this->set('_serialize', 'data');  
    }

}

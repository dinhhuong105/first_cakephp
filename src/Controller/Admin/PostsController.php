<?php

/**
 * /PostsController.php
 */

namespace App\Controller\Admin;

use Cake\Utility\Text;

/**
 * PostsController
 *
 * @since 1.0
 * @version 1.0
 * @author Dinh Van Huong
 */
class PostsController extends AdminAppController
{

    public function initialize()
    {
        parent::initialize();
        $this->loadComponent('Files');
        
    }

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
        // re-config pagination.
        $this->paginate = [
            'contain'   =>  ['Accounts', 'Tags'],
            'order'     =>  ['Posts.created_at' => 'DESC']
        ];
        
        if ($this->request->is('post')) {
            if (empty($this->request->data['ids'])) {
                $this->Flash->error(__('not_check_item'));
                return $this->redirect(['action' => 'index']);
            }
            
            if (isset($this->request->data['delete-all']) && $this->Posts->deleteAll($this->request->data['ids'])) {
                $this->Flash->success(__('delete_success'));
            } else {
                $this->Flash->error(__('delete_fail'));
            }
            
            return $this->redirect(['action' => 'index']);
        }

        $page  = (isset($this->request->params['page'])) ? $this->request->params['page'] : 1;
        $datas = $this->paginate($this->Posts, ['page' => $page]);
        
        $this->set('listTags', $this->loadModel('Tags')->getListTagsName());
        $this->set('posterAccounts', $this->loadModel('Accounts')->find('list', ['keyField' => 'id', 'valueField' => 'full_name', 'conditions' => ['group_id' => 2]])->toArray());
        $this->set('categories', $this->loadModel('Categories')->find('list', ['keyField' => 'id', 'valueField' => 'name'])->toArray());
        
        $this->set(compact('datas'));
        $this->set('_serialize', ['datas']);
        $this->set('title', __('posts'));
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
        $post = $this->Posts->newEntity();
        if ($this->request->is('post')) {
            $data           = $this->request->data;           
            $alias          = ($data['alias']) ? $data['alias'] : $data['title'];
            $picture        = $this->Files->upload($data['picture'], 'uploads/pictures/', true, 800, 600);

            $post->picture = '';
            if (isset($picture['name'])) {
                $post->picture = $picture['name'];
            }
            
            $post->title        = $data['title'];
            $post->short        = $data['short'];
            $post->content      = $data['content'];
            $post->category_id  = $data['category_id'];
            $post->author_id    = $data['author_id'];
            $post->alias        = Text::slug(strtolower($alias));
            $post->meta_title   = ($data['meta_title']) ? $data['meta_title'] : $data['title'];
            $post->meta_keyword = ($data['meta_keyword']) ? $data['meta_keyword'] : $data['title'];
            $post->meta_desc    = ($data['meta_desc']) ? $data['meta_desc'] : $data['title'];
            $post->created_at   = time();
            $post->updated_at   = time();
            
            
                
            if ($this->Posts->save($post)) {
                /* insert tags */
                $prepareTags = $this->loadModel('Tags')->prepareTags($data['tags']);
                $this->loadModel('Tags')->insertMultipleTags($prepareTags);
                $tagsID = $this->loadModel('Tags')->getTagsIdByName($data['tags']);
                $this->loadModel('PostsTags')->insert($post->id, $tagsID);
                
                $this->Flash->success(__('add_success'));
                return $this->redirect(['action' => 'index']);
            } else {             
                $this->Flash->error(__('add_fail'));
                return $this->redirect(['action' => 'add']);
            }
        }

        $this->set('listTags', $this->loadModel('Tags')->getListTagsName());
        $this->set('posterAccounts', $this->loadModel('Accounts')->find('list', ['keyField' => 'id', 'valueField' => 'full_name', 'conditions' => ['group_id' => 2]])->toArray());
        $this->set('categories', $this->loadModel('Categories')->find('list', ['keyField' => 'id', 'valueField' => 'name'])->toArray());
        $this->set(compact('post'), $post);
        $this->set('_serialize', ['post']);
        $this->set('title', __('add_new {0}', __('posts')));
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
        
        $post = $this->Posts->get($id, [
            'contain' => ['Accounts', 'Tags']
        ]);
        
        if ($this->request->is(['patch', 'post', 'put'])) {
            
            // prepare data.
            $data   = $this->request->data;
            $alias      = ($data['alias']) ? strtolower($data['alias']) : strtolower($data['title']);
            $picture    = $this->Files->upload($data['picture'], 'uploads/pictures/', true, 800, 600);

            if (isset($picture['name'])) {
                $post->picture = $picture['name'];
            } else {
                if ($data['remove_feature_image']) {
                    $post->picture = '';
                }
            }
            
            $post->title        = $data['title'];
            $post->short        = $data['short'];
            $post->content      = $data['content'];
            $post->category_id  = $data['category_id'];
            $post->author_id    = $data['author_id'];
            $post->alias        = Text::slug($alias);
            $post->meta_title   = ($data['meta_title']) ? $data['meta_title'] : $data['title'];
            $post->meta_keyword = ($data['meta_keyword']) ? $data['meta_keyword'] : $data['title'];
            $post->meta_desc    = ($data['meta_desc']) ? $data['meta_desc'] : $data['title'];
            $post->updated_at   = time();
            
            if ($this->Posts->save($post)) {
                /* insert tags */
                $this->loadModel('Tags');
                $prepareTags = $this->Tags->prepareTags($data['tags']);
                $this->Tags->insertMultipleTags($prepareTags);
                $tagsID = $this->Tags->getTagsIdByName($data['tags']);
                
                /* update posts tags */
                $this->loadModel('PostsTags');
                $this->PostsTags->deleteAll(['post_id' => $id]);
                $this->PostsTags->insert($id, $tagsID);
                
                $this->Flash->success(__('update_success'));
                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('update_fail'));
                return $this->redirect(['action' => 'edit']);
            }
        }
        
        $this->set('tags', $this->loadModel('Tags')->getListTagsName());
        $this->set('posterAccounts', $this->loadModel('Accounts')->find('list', ['keyField' => 'id', 'valueField' => 'full_name', 'conditions' => ['group_id' => 2]])->toArray());
        $this->set('categories', $this->loadModel('Categories')->find('list', ['keyField' => 'id', 'valueField' => 'name'])->toArray());
        $this->set(compact('post'), $post);
        $this->set('_serialize', ['post']);
        $this->set('title', __('edit {0}', __('posts')));
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
        
        $post = $this->Posts->get($id);
        if ($this->Posts->delete($post)) {
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

}

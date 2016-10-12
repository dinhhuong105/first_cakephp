<?php

/**
 * /PostsTagsTable.php
 */

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Posts Tags Model
 * 
 * @since 1.0
 * @version 1.0
 * @author Dinh Van Huong
 */
class PostsTagsTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('posts_tags');
        $this->displayField('id');
        $this->primaryKey('id');
    }
    
    /**
     * insert
     * 
     * @param int $postID
     * @param array $tagsID array tags id
     * @return boolean
     * 
     * @since 1.0
     * @version 1.0
     * @author Dinh Van Huong
     */
    public function insert($postID, $tagsID = [])
    {
        if (empty($postID) || empty($tagsID)) {
            return false;
        }
        
        foreach ($tagsID as $tag) {
            $postTag = $this->newEntity();
            $postTag->post_id   = $postID;
            $postTag->tag_id    = $tag;
            $this->save($postTag);
        }
        
        return true;
    }
    
    /**
     * delete 
     * 
     * @param int $postID
     * @return boolean
     * 
     * @since 1.0
     * @version 1.0
     * @author Dinh Van Huong
     */
    public function deletedByPostId($postID)
    {
        if (!$postID) {
            return false;
        }
        
        $this->deleteAll(['post_id' => $postID]);
        return true;
    }
}

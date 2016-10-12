<?php

/**
 * /TagsTable.php
 */

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Datasource\ConnectionManager;

/**
 * Tags Model
 *
 * @since 1.0
 * @version 1.0
 * @author Dinh Van Huong
 */
class TagsTable extends Table
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

        $this->table('tags');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsToMany('Posts', [
            'foreignKey'       => 'tag_id',
            'targetForeignKey' => 'post_id',
            'joinTable'        => 'posts_tags'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->notEmpty('name');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['name']));
        return $rules;
    }
    
    /**
     * get list tags name
     * 
     * @param array $options $options = [
     *      'field name'  => 'value'
     *      'field name'  => 'value'
     * ]
     * 
     * @return array tags
     *
     * @since 1.0
     * @version 1.0
     * @author Dinh Van Huong
     */
    public function getListTagsName($options = [])
    {
        $res = [];
        $tags = $this->find('all', ['conditions' => $options, 'fields' => ['id', 'name'], 'order' => ['name ASC']]);
        foreach ($tags as $tag) {
            $res[$tag->id] = $tag->name;
        }
        
        return $res;
    }
    
    /**
     * get list string tags name
     * 
     * @param array $options $options = [
     *      'field name'  => 'value'
     *      'field name'  => 'value'
     * ]
     * 
     * @return string tags (e.g tags name 1, tags_name 2, ...)
     *
     * @since 1.0
     * @version 1.0
     * @author Dinh Van Huong
     */
    public function getListStringTagsName($options = [])
    {
        return implode(',', $this->getListTagsName($options));
    }
    
    /**
     * prepare tags
     * 
     * @param array $strTags (e.g tag1, tag2, ...)
     * @return array Tags
     * 
     * @since 1.0
     * @version 1.0
     * @author Dinh Van Huong
     */
    public function prepareTags($strTags = '')
    {
        if (empty($strTags)) {
            return [];
        }
        $strTags    = strtolower($strTags);
        $inputTags  = explode(',', $strTags);
        $inputTags  = array_unique($inputTags);
        $tags       = $this->find('all', ['fields' => ['name'], 'order' => ['id ASC']]);
        foreach ($tags as $tag) {
            $tagName = strtolower($tag->name);
            if (strlen($key = array_search($tagName, $inputTags)) > 0) {
                unset($inputTags[$key]);
            }
        } 
        
        return $inputTags;
    }
    
    /**
     * insert multiple tags
     * 
     * @param array $tags tags name
     * @return array tags ID
     * 
     * @since 1.0
     * @version 1.0
     * @author Dinh Van Huong
     */
    public function insertMultipleTags($tags = [])
    {
        $tagsID = [];
        foreach ($tags as $item) {
            $tag = $this->newEntity();
            $tag->name          = $item;
            $tag->meta_title    = $item;
            $tag->meta_keyword  = $item;
            $tag->meta_desc     = $item;
            $tag->created_at    = time();
            $tag->updated_at    = time();
            $this->save($tag);
            $tagsID = $tag->id;
        } 
        
        return $tagsID;
    }
    
    /**
     * get tags id by name
     * 
     * @param array $tagsName tags name
     * @return array tags ID
     * 
     * @since 1.0
     * @version 1.0
     * @author Dinh Van Huong
     */
    public function getTagsIdByName($tagsName = '')
    {
        if (empty($tagsName)) {
            return false;
        }
        
        $tagsID = $condition = [];
        $names = explode(',', $tagsName);
        foreach ($names as $name) {
            $condition[]['name'] = $name;
        }
        
        $res    = $this->find('all', ['fields' => ['id']])->where(['OR' => $condition])->toArray();
        foreach ($res as $tag) {
            $tagsID[] = $tag->id;
        }
        
        return $tagsID;
    }
    
    /**
     * delete all tags by id
     * 
     * @param array $ids
     * @return boolean
     * 
     * @since 1.0
     * @version 1.0
     * @author Dinh Van Huong
     */
    public function deleteAll($ids) 
    {
        $ok     = true;
        $conn   = ConnectionManager::get('default');
        $conn->begin();
        
        foreach ($ids as $id) {
            $entity = $this->get($id);
            if (!$this->delete($entity)) {
                $ok = false;
                break;
            }
        }
        
        if ($ok) {
            $conn->commit();
            return true;
        } else {
            $conn->rollback();
            return false;
        }
    }

}

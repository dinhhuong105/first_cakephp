<?php

/**
 * /PostsTable.php
 */

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Datasource\ConnectionManager;

/**
 * Posts Model
 *
 * @since 1.0
 * @version 1.0
 * @author Dinh Van Huong
 */
class PostsTable extends Table
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

        $this->table('posts');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Categories', [
            'foreignKey' => 'category_id',
            'joinType'   => 'INNER'
        ]);

        $this->belongsTo('Accounts', [
            'foreignKey' => 'author_id',
            'joinType'   => 'INNER'
        ]);

        $this->belongsToMany('Tags', [
            'foreignKey'       => 'post_id',
            'targetForeignKey' => 'tag_id',
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
        $validator->notEmpty('title', __('field_required'));
        $validator->notEmpty('category_id', __('field_required'));
        $validator->notEmpty('author_id', __('field_required'));

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
        $rules->add($rules->isUnique(['title']));
        return $rules;
    }
    
    /**
     * delete all posts by id
     * 
     * @param type $ids
     * 
     * @since 1.0
     * @version 1.0
     * @author Dinh Van Huong
     */
    public function deleteAll($ids)
    {
        $conn = ConnectionManager::get('default');
        $conn->begin();
        $ok = true;
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

<?php

/**
 * /CategoriesTable.php
 */

namespace App\Model\Table;

use Cake\Event\Event;
use ArrayObject;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Datasource\ConnectionManager;

/**
 * Categories Model
 * 
 * @since 1.0
 * @version 1.0
 * @author Dinh Van Huong
 */
class CategoriesTable extends Table
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

        $this->table('categories');
        $this->displayField('id');
		$this->displayField('name');
        $this->primaryKey('id');
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
            //->requirePresence('name')
            //->notEmpty('name')
            ->notBlank('name');
        return $validator;
    }
    
    public function beforeMarshal(Event $event, ArrayObject $data)
    {
        $data['name']           = trim($data['name']);
        $data['alias']          = trim($data['alias']);
        $data['meta_title']     = trim($data['meta_title']);
        $data['meta_keyword']   = trim($data['meta_keyword']);
        $data['meta_desc']      = trim($data['meta_desc']);
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
     * delete all categories by id
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

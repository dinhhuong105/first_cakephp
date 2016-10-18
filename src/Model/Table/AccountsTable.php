<?php

/**
 * /AccountsTable.php
 */

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Datasource\ConnectionManager;

/**
 * Accounts Model
 *
 * @since 1.0
 * @version 1.0
 * @author Dinh Van Huong
 */
class AccountsTable extends Table
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

        $this->table('accounts');
        $this->displayField('id');
        $this->primaryKey('id');
        
        $this->belongsTo('AccountsGroups', [
            'foreignKey' => 'group_id',
            'joinType'   => 'INNER'
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
        $validator->requirePresence('username')
            ->notEmpty('username', __('field_required'))
            ->add('username', [
                'minLength' => [
                    'rule' => ['minLength', 3],
                    'last' => true,
                    'message' => __('error_min_length {0}', 3)
                ],
                'maxLength' => [
                    'rule' => ['maxLength', 100],
                    'message' => __('error_max_length {0} {1}', 'username', 100)
                ],
                'alphaNumeric'  => [
                    'rule'      => ['alphaNumeric'],
                    'message'   => __('only_alpha_numeric')
                ]
            ]);
        
        $validator->requirePresence('password', 'create')
            ->notEmpty('password', __('field_required'), 'create')
            ->add('password', [
                'minLength' => [
                    'rule' => ['minLength', 8],
                    'last' => true,
                    'message' => __('error_min_length {0}', 8)
                ],
                'maxLength' => [
                    'rule' => ['maxLength', 255],
                    'message' => __('error_max_length {0}', 'username')
                ],
                'alphaNumeric'  => [
                    'rule'      => ['alphaNumeric'],
                    'message'   => __('only_alpha_numeric')
                ]
            ]);
        
        $validator->requirePresence('first_name')
            ->notEmpty('first_name', __('field_required'));
        
        $validator->requirePresence('last_name')
            ->notEmpty('last_name', __('field_required'));
        
        $validator->requirePresence('group_id')
            ->notEmpty('group_id', __('field_required'));

        $validator->requirePresence('email')
            ->notEmpty('email', __('field_required'))
            ->add('email', 'validFormat', [
                'rule' => 'email',
                'message' => __('invalid_email')
            ]);
        
        $validator->allowEmpty('phone')
            ->numeric('phone', __('invalid_number'));

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
        $rules->add($rules->isUnique(['username'], __('unique_value')));
        $rules->add($rules->isUnique(['email'], __('unique_value')));
        return $rules;
    }
    
    /**
     * delete multiple account by id
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

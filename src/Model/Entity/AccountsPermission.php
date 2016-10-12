<?php

/**
 * /AccountsPermission.php
 *
 * @since 1.0
 * @version 1.0
 * @author Dinh Van Huong
 */

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Accounts Permission Entity
 *
 * @since 1.0
 * @version 1.0
 * @author Dinh Van Huong
 */
class AccountsPermission extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*'  => true,
        'id' => false
    ];
    
    /**
     * set permission's controller
     * 
     * remove all space on controller
     * 
     * @param array $controller
     * @return string serialize
     * 
     * @since 1.0
     * @version 1.0
     * @author Dinh Van Huong
     */
    protected function _setController($controller)
    {
        if (empty($controller)) {
            return '';
        }
        
        return preg_replace('/\s+/', '', $controller);
    }
    
    /**
     * set permission's action
     * 
     * @param array $actions
     * @return string serialize
     * 
     * @since 1.0
     * @version 1.0
     * @author Dinh Van Huong
     */
    protected function _setActions($actions)
    {
        if (empty($actions)) {
            return '';
        }

        return serialize(explode(',', preg_replace('/\s+/', '', $actions)));
    }
    
    /**
     * get array action | convert serialize to array.
     * 
     * @param none
     * @return string
     * 
     * @since 1.0
     * @version 1.0
     * @author Dinh Van Huong
     */
    protected function _getArrayActions()
    {
        if (empty($this->_properties['actions'])) {
            return [];
        }
        
        if (@unserialize($this->_properties['actions'])) {
            return unserialize($this->_properties['actions']);
        } else {
            return explode(',', $this->_properties['actions']);
        }
    }
    
    /**
     * get action | convert serialize to string.
     * 
     * @param none
     * @return string
     * 
     * @since 1.0
     * @version 1.0
     * @author Dinh Van Huong
     */
    protected function _getActions()
    {
        return implode(',', $this->_getArrayActions());
    }
    
    
}

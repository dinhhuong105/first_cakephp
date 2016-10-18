<?php

/**
 * /Account.php
 *
 * @since 1.0
 * @version 1.0
 * @author Dinh Van Huong
 */

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\Auth\DefaultPasswordHasher;
use Cake\I18n\Time;

/**
 * Accounts Entity
 *
 * @since 1.0
 * @version 1.0
 * @author Dinh Van Huong
 */
class Account extends Entity
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
    protected $_hidden = [
        'password'
    ];

    /**
     * set password
     * 
     * @return string password
     * 
     * @since 1.0
     * @version 1.0
     * @author Dinh Van Huong
     */
    protected function _setPassword($password)
    {
        if ($password) {
            return (new DefaultPasswordHasher)->hash($password);
        }
    }
    
    /**
     * get full name of user
     * 
     * @return string full_name
     * 
     * @since 1.0
     * @version 1.0
     * @author Dinh Van Huong
     */
    protected function _getFullName()
    {
        return $this->_properties['first_name'] . ' ' . $this->_properties['last_name'];
    }
        
    /**
     * get last time login
     * 
     * @return string dateTime
     * 
     * @since 1.0
     * @version 1.0
     * @author Dinh Van Huong
     */
    protected function _getLastLoginDate()
    {
        return ($this->_properties['last_login']) ? date('Y/m/d H:i', $this->_properties['last_login']) : '';
    }

}

<?php

/**
 * /AccountsGroup.php
 *
 * @since 1.0
 * @version 1.0
 * @author Dinh Van Huong
 */

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Accounts Group Entity
 *
 * @since 1.0
 * @version 1.0
 * @author Dinh Van Huong
 */
class AccountsGroup extends Entity
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
        '*' => false,
        'id' => false
    ];
}

<?php

/**
 * /Categorie.php
 *
 * @since 1.0
 * @version 1.0
 * @author Dinh Van Huong
 */

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Categories Entity
 *
 * @since 1.0
 * @version 1.0
 * @author Dinh Van Huong
 */
class Categorie extends Entity
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
        '*' => true,
        'id' => false
    ];
}

<?php
declare(strict_types=1);

namespace TestPlugin\Model\Entity;

use Cake\ORM\Entity;

/**
 * Bill Entity
 *
 * @property int $id
 * @property int $customer_id
 * @property int $article_id
 * @property float $amount
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \TestPlugin\Model\Entity\Customer $customer
 * @property \TestPlugin\Model\Entity\Article $article
 */
class Bill extends Entity
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
        'customer_id' => true,
        'article_id' => true,
        'amount' => true,
        'created' => true,
        'modified' => true,
        'customer' => true,
        'article' => true,
    ];
}

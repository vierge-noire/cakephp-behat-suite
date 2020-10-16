<?php
declare(strict_types=1);

/**
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) 2020 Juan Pablo Ramirez and Nicolas Masson
 * @link          https://webrider.de/
 * @since         1.0.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace TestApp\Model\Table;

use Cake\ORM\Table;
use Cake\Utility\Hash;
use TestApp\Model\Entity\User;

class UsersTable extends Table
{
    public function initialize(array $config): void
    {
        $this->addBehavior('Timestamp');

        $this->addAssociations([
            'belongsToMany' => [
                'UsersGroups'
            ],
        ]);

        parent::initialize($config);
    }

    /**
     * @param User   $user
     * @param string $permission
     *
     * @return bool
     */
    public function hasPermission(User $user, string $permission)
    {
        $allowed = ['Admin', 'Guru', $permission];
        $permissions = Hash::extract($user->toArray(), 'users_groups.{n}.permissions.{n}.name');
        return !empty(array_intersect($allowed, $permissions));
    }
}

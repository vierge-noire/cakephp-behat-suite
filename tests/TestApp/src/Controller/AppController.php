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

namespace TestApp\Controller;

use Cake\Controller\Controller;
use Cake\Event\EventInterface;
use TestApp\Model\Table\UsersTable;

class AppController extends Controller
{
    /**
     * @var UsersTable
     */
    public $Users;

    public function initialize(): void
    {
        $this->loadModel('Users');
        $this->loadComponent('Flash');
    }

    public function beforeFilter(EventInterface $event)
    {
        if ($this->getName() === 'Pages') {
            return parent::beforeFilter($event);
        }

        $user = $this->getRequest()->getSession()->read('Auth.User');
        $controller = $this->getName();

        if (!$this->Users->hasPermission($user, $controller)) {
            return $this->redirect('home');
        }
    }
}
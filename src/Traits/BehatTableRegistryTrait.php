<?php

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

namespace CakephpBehatSuite\Traits;

use Behat\Gherkin\Node\TableNode;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Utility\Inflector;
use CakephpBehatSuite\BehatUtil;
use PHPUnit\Framework\Assert;

trait BehatTableRegistryTrait
{
    /**
     * @param string $table
     *
     * @return Table
     */
    public function getTable(string $table): Table
    {
        return TableRegistry::getTableLocator()->get(
            ucfirst(Inflector::pluralize($table))
        );
    }

    /**
     * @Then this :model exists:
     *
     * @param string    $model
     * @param TableNode $data
     * @return void
     */
    public function thisModelExists(string $model, TableNode $data): void
    {
        $data = BehatUtil::processTableNode($data);
        Assert::assertTrue($this->getTable($model)->exists($data));
    }

    /**
     * @Then the :model with id :id exists
     *
     * @param string    $model
     * @param int       $id
     * @return void
     */
    public function theModelWithIdExists(string $model, int $id): void
    {
        Assert::assertTrue($this->getTable($model)->exists(compact('id')));
    }

    /**
     * @Then the :model with id :id does not exist
     *
     * @param string    $model
     * @param int       $id
     * @return void
     */
    public function theModelWithIdDoesNotExists(string $model, int $id): void
    {
        Assert::assertFalse($this->getTable($model)->exists(compact('id')));
    }
}
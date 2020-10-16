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

namespace CakephpBehatSuite\Traits;

use Behat\Gherkin\Node\TableNode;
use Cake\Datasource\EntityInterface;
use Cake\Datasource\ResultSetInterface;
use CakephpBehatSuite\BehatUtil;
use Exception;

trait BehatFixtureFactoriesTrait
{
    /**
     * @Given I create :n :model
     *
     * @param int|string $n
     * @param string $model
     * @return array|EntityInterface|EntityInterface[]|ResultSetInterface|false|null
     * @throws Exception
     */
    public function iCreateModel($n, string $model)
    {
        return BehatUtil::getFixtureFactory($model)
            ->setTimes(BehatUtil::processN($n))
            ->persist();
    }

    /**
     * @Given I create :n :modelName with :field :value
     *
     * @param int    $n
     * @param string $modelName
     * @param string  $field
     * @param int|string  $value
     * @return array|EntityInterface|EntityInterface[]|ResultSetInterface|false|null
     * @throws Exception
     */
    public function iCreateModelWithField(int $n, string $modelName, string $field, $value)
    {
        return BehatUtil::getFixtureFactory($modelName)
            ->patchData([$field => $value])
            ->setTimes($n)
            ->persist();
    }

    /**
     * @Given I create :n :modelName :
     *
     * @param int    $n
     * @param string $modelName
     * @param TableNode  $data
     * @return array|EntityInterface|EntityInterface[]|ResultSetInterface|false|null
     * @throws Exception
     */
    public function iCreateModelWithData(int $n, string $modelName, TableNode $data)
    {
        return BehatUtil::getFixtureFactory($modelName)
            ->patchData(BehatUtil::processTableNode($data))
            ->setTimes($n)
            ->persist();
    }

    /**
     * @Given I create :n :modelName with :m :associationPath :field :value
     *
     * @param int|string    $n
     * @param string $modelName
     * @param int|string  $m
     * @param string $associationPath
     * @param string $field
     * @param string|int $value
     * @return array|EntityInterface|EntityInterface[]|ResultSetInterface|false|null
     */
    public function iCreateModelWithAssociatedField($n, string $modelName, $m, string $associationPath, string $field, $value)
    {
        $m = BehatUtil::processN($m);
        return BehatUtil::getFixtureFactory($modelName)
            ->setTimes(BehatUtil::processN($n))
            ->with($associationPath."[$m]", [$field => $value])
            ->persist();
    }

    /**
     * @Given I create :n :modelName with :associationPath :
     *
     * @param int    $n
     * @param string $modelName
     * @param string $associationPath
     * @param TableNode $data
     * @return array|EntityInterface|EntityInterface[]|ResultSetInterface|false|null
     */
    public function iCreateModelWithAssociatedData(int $n, string $modelName, string $associationPath, TableNode $data)
    {
        $data = BehatUtil::processTableNode($data);

        return BehatUtil::getFixtureFactory($modelName)
            ->setTimes($n)
            ->with($associationPath, $data)
            ->persist();
    }
}
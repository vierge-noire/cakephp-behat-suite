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

namespace CakephpBehatSuite;

use Behat\Gherkin\Node\TableNode;
use Cake\Utility\Inflector;
use CakephpFixtureFactories\Factory\BaseFactory;
use CakephpFixtureFactories\Util;

class BehatUtil
{
    /**
     * If only one entry is provided, it returns that first entry only
     *
     * @param TableNode $table
     *
     * @return array
     */
    public static function processTableNode(TableNode $table): array
    {
        $data = $table->getColumnsHash();
        if (count($data) === 1) {
            return $data[0];
        } else {
            return $data;
        }
    }

    /**
     * Convert words in 1, if they match a certain pattern
     *
     * @param int|string $n
     *
     * @return int
     */
    public static function processN($n): int
    {
        if (is_string($n)) {
            if (in_array($n, [
                'a', 'an', 'the', 'this', 'that', 'some',
            ])) {
                $n = 1;
            } else {
                $n = (int) $n;
            }
        }
        return $n;
    }

    /**
     * @param string $modelName
     *
     * @return BaseFactory
     */
    public static function getFixtureFactory(string $modelName): BaseFactory
    {
        $modelName = ucfirst(Inflector::pluralize($modelName));
        $factoryName = Util::getFactoryClassFromModelName($modelName);
        return $factoryName::make();
    }
}
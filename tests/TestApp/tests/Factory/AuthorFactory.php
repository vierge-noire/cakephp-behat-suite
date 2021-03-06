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
namespace TestApp\Test\Factory;

use CakephpFixtureFactories\Factory\BaseFactory;
use Faker\Generator;

class AuthorFactory extends BaseFactory
{
    protected function getRootTableRegistryName(): string
    {
        return "Authors";
    }

    protected function setDefaultTemplate(): void
    {
        $this
            ->setDefaultData(function (Generator $faker) {
                return [
                    'name' => $faker->name
                ];
            })
            ->withAddress();
    }

    public function withArticles($parameter = null, int $n = 1)
    {
        return $this->with('Articles', ArticleFactory::make($parameter, $n)->without('Authors'));
    }

    public function withAddress($parameter = null)
    {
        return $this->with('Address', AddressFactory::make($parameter));
    }
}

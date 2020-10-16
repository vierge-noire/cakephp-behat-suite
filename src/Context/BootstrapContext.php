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

namespace CakephpBehatSuite\Context;

use Behat\Behat\Context\Context;
use Cake\TestSuite\TestCase;
use CakephpBehatSuite\Traits\BehatIntegrationTrait;
use CakephpTestSuiteLight\FixtureInjector;
use CakephpTestSuiteLight\FixtureManager;

class BootstrapContext extends TestCase implements Context
{
    use BehatIntegrationTrait;

    /**
     * @var FixtureInjector $fixtureInjector
     */
    protected $fixtureInjector;

    /**
     * BootstrapContext constructor.
     *
     * @param string $bootstrap
     */
    public function __construct(string $bootstrap)
    {
        require_once $bootstrap;
        $this->fixtureInjector = new FixtureInjector(new FixtureManager());
    }

    /** @BeforeScenario */
    public function beforeScenario(): void
    {
        $this->fixtureInjector->startTest($this);
    }
}
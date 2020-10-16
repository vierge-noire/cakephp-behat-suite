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
use Cake\TestSuite\IntegrationTestTrait;
use CakephpBehatSuite\BehatUtil;
use Exception;


trait BehatIntegrationTrait
{
    use IntegrationTestTrait;
    use BehatFixtureFactoriesTrait;
    use BehatTableRegistryTrait;

    /**
     * @var EntityInterface $user
     */
    public $user;

    /**
     * @Given I am a/an :model
     *
     * @param string $model
     * @return void
     * @throws Exception
     */
    public function iAmModel(string $model): void
    {
        $this->user = $this->iCreateModel(1, $model);
    }

    /**
     * @Given I am a/an :model with :field :value
     *
     * @param string $model
     * @param string $field
     * @param string|int $value
     * @return void
     * @throws Exception
     */
    public function iAmModelWithField(string $model, string $field, $value): void
    {
        $this->user = $this->iCreateModelWithField(1, $model, $field, $value);
    }

    /**
     * @Given I am a/an :model :
     *
     * @param string $modelName
     * @param TableNode  $data
     * @return void
     * @throws Exception
     */
    public function iAmModelWithData(string $modelName, TableNode $data): void
    {
        $this->user = $this->iCreateModelWithData(1, $modelName, $data);
    }

    /**
     * @Given I am a/an :modelName with :m :associationPath :field :value
     *
     * @param string $modelName
     * @param int|string  $m
     * @param string $associationPath
     * @param string $field
     * @param string|int $value
     * @return void
     * @throws Exception
     */
    public function iAmModelWithAssociatedField(string $modelName, $m, string $associationPath, string $field, $value): void
    {
        $this->user = $this->iCreateModelWithAssociatedField(1, $modelName, $m, $associationPath, $field, $value);
    }

    /**
     * @Given I am a/an :modelName with :associationPath :
     *
     * @param string $modelName
     * @param int|string  $m
     * @param string $associationPath
     * @param TableNode $data
     * @return void
     * @throws Exception
     */
    public function iAmModelWithAssociatedData(string $modelName, $m, string $associationPath, TableNode $data): void
    {
        $this->user = $this->iCreateModelWithAssociatedData(1, $modelName, $associationPath, $data);
    }

    /**
     * @Given I log in
     *
     * @return void
     * @throws Exception
     */
    public function logIn(): void
    {
        if (!isset($this->user)) {
            throw new Exception('You should define who you are before you log in.');
        }

        $this->session([
            'Auth' => [
                'User' => $this->user,
            ]
        ]);
    }

    /**
     * @Given I log in as :model with id :id
     *
     * @param string $model
     * @param int $id
     * @return void
     * @throws Exception
     */
    public function logInWithId(string $model, int $id): void
    {
        $this->user = $this->getTable($model)->get($id);

        $this->session([
            'Auth' => [
                'User' => $this->user,
            ]
        ]);
    }

    /**
     * @Given I get :url
     *
     * @param string    $url
     * @return void
     */
    public function getUrl(string $url): void
    {
        $this->get($url);
    }

    /**
     * @Given I post :url with data:
     *
     * @param string    $url
     * @param array|TableNode     $data
     * @return void
     */
    public function postUrlWithData(string $url, $data): void
    {
        if ($data instanceof TableNode) {
            $data = BehatUtil::processTableNode($data);
        }

        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $this->post($url, $data);
    }

    /**
     * @Given I post :url
     *
     * @param string    $url
     * @return void
     */
    public function postUrl(string $url): void
    {
        $this->postUrlWithData($url, []);
    }

    /**
     * @Given I put :url with data:
     *
     * @param string    $url
     * @param array|TableNode     $data
     * @return void
     */
    public function putUrlWithData(string $url, $data): void
    {
        if ($data instanceof TableNode) {
            $data = BehatUtil::processTableNode($data);
        }

        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $this->put($url, $data);
    }

    /**
     * @Given I put :url
     *
     * @param string    $url
     * @return void
     */
    public function putUrl(string $url): void
    {
        $this->putUrlWithData($url, []);
    }

    /**
     * @Given I delete :url
     *
     * @param string    $url
     * @return void
     */
    public function deleteUrl(string $url): void
    {
        $this->enableCsrfToken();
        $this->enableSecurityToken();

        $this->delete($url);
    }

    /**
     * @Then the response is OK
     *
     * @return void
     */
    public function theResponseIsOK(): void
    {
        $this->assertResponseOk();
    }

    /**
     * @Then I am redirected
     *
     * @return void
     */
    public function iShallBeRedirected(): void
    {
        $this->assertResponseCode(302);
    }

    /**
     * @Then I am redirected to :string
     *
     * @param string $url
     * @return void
     */
    public function iShallBeRedirectedTo(string $url): void
    {
        $this->assertRedirect($url);
        $this->iShallBeRedirected();
    }

    /**
     * @Then the response fails
     *
     * @return void
     */
    public function theResponseFails(): void
    {
        $this->assertResponseFailure();
    }

    /**
     * @Then the response triggers an error
     *
     * @return void
     */
    public function theResponseTriggersAnError(): void
    {
        $this->assertResponseError();
    }

    /**
     * @Then the response contains :string
     *
     * @param string $string
     * @return void
     */
    public function theResponseContains(string $string): void
    {
        $this->assertResponseContains($string);
    }
}
# cakephp-behat-suite
A CakePHP dedicated suite for behavior driven development.

## Installation
For CakePHP 4.x:
```
composer require --dev vierge-noire/cakephp-behat-suite "^0.2"
```

## Setup

Copy this file in the main directory of your app, under the name `behat.yml:
```
#behat.yml
default:
  autoload:
    '': '%paths.base%/tests/Behat'
  suites:
    app:
      paths:
        - '%paths.base%/tests/Behat/features'
      contexts:
        - CakephpBehatSuite\Context\BootstrapContext:
            bootstrap: '%paths.base%/tests/bootstrap.php'
        - Context\AppContext
```

The `behat.yml` file is the equivalent to the PHPUnit's `phpunit.xml` file. `%paths.base%` points to your main directory.

Once your `behat.yml` file has been created, run `vendor/bin/behat --init` to automatically create the folders and Context
classes as defined in the config file.

You can define more suites additional to app, for example for your plugins.

IMPORTANT: the `CakephpBehatSuite\Context\BootstrapContext` should be present in each of your suites.
The argument `bootstrap:` should direct to the `bootstrap.php` file of your tests.
 
For each suite, you will have to specify the location of your features under the key `path`. 

The package provides a set of steps defined by `CakephpBehatSuite\Context\BootstrapContext`.

## Fixture factories
The package makes uses of the CakePHP fixture factories plugin. Make sure your factories are
baked and working, in order to use the present package.

You will find the package and its documentation [here](https://github.com/vierge-noire/cakephp-fixture-factories).

## The BootstrapContext class
The `CakephpBehatSuite\Context\BootstrapContext` contains a set of steps, documented below.

The Context will ensure that the test database gets emptied before each scenario.

## Example
### behat.yml with plugin

This behat file includes a suite for a dummy plugin MyCustomPlugin. For each suite, a Context has been added too.

Once your `behat.yml` file has been created, run `vendor/bin/behat --init` to automatically create the folders and Context
classes as defined in the config file.

```
#behat.yml
default:
  autoload:
    '': '%paths.base%/tests/Behat'
  suites:
    app:
      paths:
        - '%paths.base%/tests/Behat/features'
      contexts:
        - CakephpBehatSuite\Context\BootstrapContext:
            bootstrap: '%paths.base%/tests/bootstrap.php'
        - Context\AppContext
    my-custom-plugin:
      paths:
        - '%paths.base%/plugins/MyCustomPlugin/tests/Behat/features'
      contexts:
        - CakephpBehatSuite\Context\BootstrapContext:
            bootstrap: '%paths.base%/tests/bootstrap.php'
        - Context\TestPluginContext
```

### Feature
```
Feature: Users edit

  Background:
    Given I create 1 user with id 1
    And I am a user with a UsersGroups.Permissions name Users
    And I log in

  Scenario:
    When I get 'users/edit/1'
    Then the response is OK

# Delete a non existent user
  Scenario:
    When I get 'users/edit/2'
    Then the response triggers an error
    
# Edit an existing user
  Scenario:
    When I post 'users/edit/1' with data:
      | username  | email          |
      | foo       | foo@foo.foo    |
    Then I shall be redirected to 'users'
    And this user exists:
      | id  | username  | email          |
      | 1   | foo       | foo@foo.foo    |

```

## Use Migrations

Take full advantage of the [Phinx migrations](https://book.cakephp.org/migrations/3/en/index.html) in order to maintain the schema
of your test DB. This is optional, but __highly recommended__.

The [CakePHP Test Migrator package](https://github.com/vierge-noire/cakephp-test-migrator) will assist you in doing this very simply.


## License

The CakePHPFixtureFactories plugin is offered under an [MIT license](https://opensource.org/licenses/mit-license.php).

Copyright 2020 Juan Pablo Ramirez and Nicolas Masson

Licensed under The MIT License Redistributions of files must retain the above copyright notice.

## Authors
* Juan Pablo Ramirez
* Nicolas Masson

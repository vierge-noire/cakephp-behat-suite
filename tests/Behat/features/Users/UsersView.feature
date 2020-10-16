Feature: Users view

  Background:
    Given I am a user with a UsersGroups.Permissions name Users
    And I log in
#    And I create a user with id 1
    And I create a user :
      | id | username    | email          |
      | 1  | foouser     | foo@foo.foo    |

  Scenario:
    When I get 'users/view/1'
    Then the response is OK
    And the response contains 'foouser'
    And the response contains 'foo@foo.foo'


  Scenario:
    When I get 'users/view/2'
    Then the response triggers an error

  Scenario:
    Given I am a user with a UsersGroups.Permissions name Foo
    And I log in
    When I get 'users/view/1'
    Then I am redirected to 'home'

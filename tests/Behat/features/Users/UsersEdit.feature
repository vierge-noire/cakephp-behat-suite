Feature: Users edit

  Background:
    Given I am a user with a UsersGroups.Permissions name Users
    And I log in
    And I create a user :
      | id | username    | email          |
      | 1  | foouser     | foo@foo.foo    |

  Scenario:
    When I get 'users/edit/1'
    Then the response is OK
    And the response contains 'foo@foo.foo'
    And the response contains 'foouser'

# Edit a non existent user
  Scenario:
    When I get 'users/edit/2'
    Then the response triggers an error

# Edit an existing user
  Scenario:
    When I post 'users/edit/1' with data:
      | username      | email          |
      | baruser       | bar@bar.bar    |
    Then I am redirected to 'users'
    And this user exists:
      | id  | username  | email          |
      | 1   | baruser   | bar@bar.bar    |
    And the flash message shows 'The user has been saved.'


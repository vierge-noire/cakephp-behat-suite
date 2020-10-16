Feature: Users edit

  Background:
    Given I create 1 user with id 1
    And I am a user with a UsersGroups.Permissions name Users
    And I log in

  Scenario:
    When I get 'users/edit/1'
    Then the response is OK

#  Delete a non existent user
  Scenario:
    When I get 'users/edit/2'
    Then the response triggers an error

  Scenario:
    When I post 'users/edit/1' with data:
      | username  | email          |
      | foo       | foo@foo.foo    |
    Then I shall be redirected to 'users'
    And this user exists:
      | id  | username  | email          |
      | 1   | foo       | foo@foo.foo    |


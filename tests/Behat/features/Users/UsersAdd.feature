Feature: Users add

  Background:
    Given I am a user with a UsersGroups.Permissions name Users
    And I log in

  Scenario:
    When I get 'users/add'
    Then the response is OK

  Scenario:
    When I post 'users/add' with data:
      | username  | email          | password |
      | foo       | foo@foo.foo    | 1234     |
    Then this user exists:
      | username  | email          |
      | foo       | foo@foo.foo    |
    And I am redirected to 'users'
    And the flash message shows 'The user has been saved.'

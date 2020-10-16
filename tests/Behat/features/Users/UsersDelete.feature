Feature: Users delete

  Background:
    Given I create 1 user with id 1
    Given I am a user with an UsersGroups.Permissions name Users
    And I log in

#  Only post or delete method is allowed
  Scenario:
    When I get 'users/delete/1'
    Then the response triggers an error
    And the user with id 1 exists

#  Delete a non existent user
  Scenario:
    When I post 'users/delete/2'
    Then the response triggers an error

  Scenario:
    When I post 'users/delete/1'
    Then the user with id 1 does not exist
    And I am redirected to 'users'

  Scenario:
    When I delete 'users/delete/1'
    Then the user with id 1 does not exist
    And I am redirected to 'users'
Feature: Users index

  Background:
    Given I create 1 user with id 1
    And I am a user with a UsersGroups.Permissions name Users
    And I log in

  Scenario:
    When I get 'users/index'
    Then the response is OK

#  Get a non existing address
  Scenario:
    When I get 'users/foo'
    Then the response triggers an error

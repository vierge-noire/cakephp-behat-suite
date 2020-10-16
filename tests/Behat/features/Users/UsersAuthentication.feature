Feature: Users authentication

  Background:
   Given I create 1 user with id 1

#  User with correct permission
  Scenario:
    Given I am a user with a UsersGroups.Permissions name Users
    And I log in
    When I get 'users/view/1'
    Then the response is OK

#  User with correct permission on non existing entity
  Scenario:
    Given I am a user with a UsersGroups.Permissions name Users
    And I log in
    When I get 'users/view/2'
    Then the response triggers an error

#  User without permission
  Scenario:
    Given I am an user
    And I log in
    When I get 'users/view/1'
    Then I shall be redirected to 'home'
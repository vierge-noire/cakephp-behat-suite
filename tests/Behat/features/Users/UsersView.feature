Feature: Users view

  Background:
    Given I create 1 user with id 1
    Given I am a user with a UsersGroups.Permissions name Users
    And I log in

  Scenario:
    When I get 'users/view/1'
    Then the response is OK

  Scenario:
    When I get 'users/view/200'
    Then the response triggers an error

  Scenario:
    Given I am a user with a UsersGroups.Permissions name Foo
    Given I log in
    When I get 'users/view/1'
    Then I shall be redirected to 'home'

Feature: Users index

  Background:
    Given I am a user with a UsersGroups.Permissions name Users
    And I log in

  Scenario:
    When I create a user :
    | username  | email        |
    | foo       | bar@bar.bar  |
    And I get 'users/index'
    Then the response is OK
    And the response contains 'foo'
    And the response contains 'bar@bar.bar'

#  Get a non existing address
  Scenario:
    When I get 'users/foo'
    Then the response triggers an error

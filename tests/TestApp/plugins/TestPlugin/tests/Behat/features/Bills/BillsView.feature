Feature: Bills view

  Background:
    Given I create 1 TestPlugin.bill with id 1
    And I am a user with a UsersGroups.Permissions name Bills
    And I log in

  Scenario:
    When I get 'test-plugin/bills/view/1'
    Then the response is OK

  Scenario:
    When I get 'test-plugin/bills/view/200'
    Then the response triggers an error

  Scenario:
    Given I am a user with a UsersGroups.Permissions name Foo
    And I log in
    When I get 'test-plugin/bills/view/1'
    Then I am redirected to 'home'

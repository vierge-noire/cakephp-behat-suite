Feature: Pages display

  Scenario:
    When I get '/'
    Then the response is OK

  Scenario:
    When I get '/pages/home'
    Then the response is OK

  Scenario:
    When I get 'pages/foo'
    Then the response fails
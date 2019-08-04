Feature: Hitting a bee
  In order to kill bees
  As a player
  I want to hit a bee and damage it

  Scenario: Hitting the queen bee
    Given there is a queen bee with full lifespan
    When I hit the queen bee
    Then the queen bee should have 92 remaining hit points
    Then the queen bee should still be alive

  Scenario: Killing the queen bee
    Given there is a queen bee with 4 remaining hit points
    When I hit the queen bee
    Then the queen bee should have 0 remaining hit points
    Then the queen bee should be dead

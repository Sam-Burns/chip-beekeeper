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

  @wip
  Scenario: Worker bee's lifespan
    Given there is a worker bee with full lifespan
    Then the worker bee should have 75 remaining hit points

  @wip
  Scenario: Hitting a worker bee
    Given there is a worker bee with full lifespan
    When I hit the worker bee
    Then the worker bee should have 65 remaining hit points

  @wip
  Scenario: Drone bee's lifespan
    Given there is a drone bee with full lifespan
    Then the worker bee should have 50 remaining hit points

  @wip
  Scenario: Hitting a drone bee
    Given there is a drone bee with full lifespan
    When I hit the drone bee
    Then the drone bee should have 38 remaining hit points

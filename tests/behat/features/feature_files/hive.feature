Feature: Hitting bees in the hive
  In order to kill bees
  As a player
  I want to attack the hive and hit a random bee

  Scenario: Initial hive population
    Given there is a new hive
    Then the hive should have 1 queen bee, 5 worker bees and 8 drone bees

  Scenario: Hitting the hive
    Given there is a new hive
    When I hit a random bee
    Then the hive should have 1 queen bee, 5 worker bees and 8 drone bees

  Scenario: Hitting the hive until all bees are dead
    Given there is a new hive
    When I hit the hive until all bees are dead
    Then the number of hits required should have been no more than 93

  Scenario: Killing the whole hive by killing the queen bee
    Given there is a new hive
    When I hit the queen bee 13 times
    Then the queen bee of the hive should be dead
    And therefore all the bees should be dead

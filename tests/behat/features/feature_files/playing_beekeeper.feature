Feature: Playing the game
  In order to play a game
  As the player
  I want to type 'hit' a lot to hit bees

  @cli
  Scenario: Playing the game
    When I run the game and type hit repeatedly
    Then I should be informed of how many hits were needed to destroy the hive
    And that number should be less than 94 hits

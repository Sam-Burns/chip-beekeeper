<?php
namespace BehatContexts;

use Behat\Behat\Context\Context;
use ChipBeekeeper\Domain\QueenBee;
use PHPUnit\Framework\Assert;

class ServiceLevelContext implements Context
{
    private $queenBee;

    /**
     * @Given there is a queen bee with full lifespan
     */
    public function thereIsAQueenBeeWithFullLifespan()
    {
        $this->queenBee = QueenBee::newWithFullLifespan();
    }

    /**
     * @Given there is a queen bee with :remainintHitPoints remaining hit points
     */
    public function thereIsAQueenBeeWithRemainingHitPoints(int $remainingHitPoints)
    {
        $this->queenBee = QueenBee::newWithRemainingHitPoints($remainingHitPoints);
    }

    /**
     * @When I hit the queen bee
     */
    public function iHitTheQueenBee()
    {
        $this->queenBee->hit();
    }

    /**
     * @Then the queen bee should have :remainingHitPoints remaining hit points
     */
    public function theQueenBeeShouldHaveRemainingHitPoints(int $remainingHitPoints)
    {
        $actualRemainingHitPoints = $this->queenBee->getRemainingHitPoints();
        Assert::equalTo($remainingHitPoints, $actualRemainingHitPoints);
    }

    /**
     * @Then the queen bee should still be alive
     */
    public function theQueenBeeShouldStillBeAlive()
    {
        Assert::isTrue($this->queenBee->isAlive());
    }

    /**
     * @Then the queen bee should be dead
     */
    public function theQueenBeeShouldBeDead()
    {
        Assert::isFalse($this->queenBee->isAlive());
    }
}

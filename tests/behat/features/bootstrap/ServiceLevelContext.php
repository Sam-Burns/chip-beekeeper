<?php
namespace BehatContexts;

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use ChipBeekeeper\Domain\DroneBee;
use ChipBeekeeper\Domain\QueenBee;
use ChipBeekeeper\Domain\WorkerBee;
use PHPUnit\Framework\Assert;

class ServiceLevelContext implements Context
{
    private $queenBee;

    private $workerBee;

    private $droneBee;

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

    /**
     * @Given there is a worker bee with full lifespan
     */
    public function thereIsAWorkerBeeWithFullLifespan()
    {
        $this->workerBee = WorkerBee::newWithFullLifespan();
    }

    /**
     * @Then the worker bee should have :remainingHitPoints remaining hit points
     */
    public function theWorkerBeeShouldHaveRemainingHitPoints($remainingHitPoints)
    {
        $actualRemainingHitPoints = $this->workerBee->getRemainingHitPoints();
        Assert::equalTo($remainingHitPoints, $actualRemainingHitPoints);
    }

    /**
     * @When I hit the worker bee
     */
    public function iHitTheWorkerBee()
    {
        $this->workerBee->hit();
    }

    /**
     * @When I hit the drone bee
     */
    public function iHitTheDroneBee()
    {
        $this->droneBee->hit();
    }

    /**
     * @Given there is a drone bee with full lifespan
     */
    public function thereIsADroneBeeWithFullLifespan()
    {
        $this->droneBee = DroneBee::newWithFullLifespan();
    }

    /**
     * @Then the drone bee should have :remainingHitPoints remaining hit points
     */
    public function theDroneBeeShouldHaveRemainingHitPoints($remainingHitPoints)
    {
        $actualRemainingHitPoints = $this->droneBee->getRemainingHitPoints();
        Assert::equalTo($remainingHitPoints, $actualRemainingHitPoints);
    }
}

<?php
namespace BehatContexts;

use Behat\Behat\Context\Context;
use ChipBeekeeper\Domain\DroneBee;
use ChipBeekeeper\Domain\Hive;
use ChipBeekeeper\Domain\QueenBee;
use ChipBeekeeper\Domain\WorkerBee;
use PHPUnit\Framework\Assert;

class ServiceLevelContext implements Context
{
    /** @var QueenBee */
    private $queenBee;

    /** @var WorkerBee */
    private $workerBee;

    /** @var WorkerBee */
    private $droneBee;

    /** @var Hive */
    private $hive;

    /** @var int */
    private $numberOfHits;

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
     * @Then the queen bee of the hive should be dead
     */
    public function theQueenBeeOfTheHiveShouldBeDead()
    {
        Assert::isFalse($this->hive->getQueen()->isAlive());
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

    /**
     * @Given there is a new hive
     */
    public function thereIsANewHive()
    {
        $this->hive = new Hive();
    }

    /**
     * @Then the hive should have :noOfQueenBees queen bee, :noOfWorkerBees worker bees and :noOfDroneBees drone bees
     */
    public function theHiveShouldHaveQueenBeeWorkerBeesAndDroneBees(
        int $noOfQueenBees,
        int $noOfWorkerBees,
        int $noOfDroneBees
    ) {
        Assert::equalTo($noOfQueenBees, $this->hive->getBeeSwarm()->getNoOfQueenBees());
        Assert::equalTo($noOfWorkerBees, $this->hive->getBeeSwarm()->getNoOfWorkerBees());
        Assert::equalTo($noOfDroneBees, $this->hive->getBeeSwarm()->getNoOfDroneBees());
    }

    /**
     * @When I hit a random bee
     */
    public function iHitARandomBee()
    {
        $this->hive->hitRandomBee();
    }

    /**
     * @When I hit the hive until all bees are dead
     */
    public function iHitTheHiveUntilAllBeesAreDead()
    {
        $this->numberOfHits = 0;
        while (!$this->hive->allBeesAreDead()) {
            $this->hive->hitRandomBee();
            ++$this->numberOfHits;
        }
    }

    /**
     * @Then the number of hits required should have been no more than :maxTotalHits
     */
    public function theNumberOfHitsRequiredShouldHaveBeenNoMoreThan(int $maxTotalHits)
    {
        Assert::lessThanOrEqual($maxTotalHits, $this->numberOfHits);
    }

    /**
     * @When I hit the queen bee :noOfHits times
     */
    public function iHitTheQueenBeeTimes($noOfHits)
    {
        for ($hitNo = 1; $hitNo <= $noOfHits; ++$hitNo) {
            $this->hive->hitQueenBee();
        }
    }

    /**
     * @Then therefore all the bees should be dead
     */
    public function thereforeAllTheBeesShouldBeDead()
    {
        Assert::isTrue($this->hive->allBeesAreDead());
    }
}

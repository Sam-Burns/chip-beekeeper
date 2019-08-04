<?php
namespace ChipBeekeeper\Domain;

class Hive
{
    /** @var QueenBee */
    private $queenBee;

    /** @var BeeSwarm */
    private $beeCollection;

    public function __construct()
    {
        $this->queenBee = QueenBee::newWithFullLifespan();

        $workerBees = [];
        for ($beeNo = 1; $beeNo <= 5; $beeNo++) {
            $workerBees[] = WorkerBee::newWithFullLifespan();
        }

        $droneBees = [];
        for ($beeNo = 1; $beeNo <= 8; $beeNo++) {
            $droneBees[] = DroneBee::newWithFullLifespan();
        }

        $this->beeCollection = new BeeSwarm([$this->queenBee], $workerBees, $droneBees);
    }

    public function getQueen(): QueenBee
    {
        return $this->queenBee;
    }

    public function noOfQueenBees(): int
    {
        return $this->beeCollection->getNoOfQueens();
    }

    public function noOfWorkerBees(): int
    {
        return $this->beeCollection->getNoOfWorkerBees();
    }

    public function noOfDroneBees(): int
    {
        return $this->beeCollection->getNoOfDroneBees();
    }

    public function hitQueenBee()
    {
        $this->queenBee->hit();
    }

    public function hitRandomBee(): Bee
    {
        $randomBee = $this->getRandomLiveBee();
        $randomBee->hit();
        $this->ifQueenBeeIsDeadThenKillAllOtherBees();
        return $randomBee;
    }

    private function ifQueenBeeIsDeadThenKillAllOtherBees()
    {
        if (!$this->queenBee->isAlive()) {
            foreach ($this->beeCollection->getAllBees() as $bee) {
                $bee->kill();
            }
        }
    }

    private function getRandomLiveBee(): Bee
    {
        return $this->beeCollection->getRandomLiveBee();
    }

    public function allBeesAreDead(): bool
    {
        return $this->beeCollection->allBeesAreDead();
    }
}

<?php
namespace ChipBeekeeper\Domain;

class Hive
{
    /** @var QueenBee */
    private $queenBee;

    /** @var BeeSwarm */
    private $beeSwarm;

    /** @var ?Bee */
    private $lastBeeHit;

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

        $this->beeSwarm = new BeeSwarm([$this->queenBee], $workerBees, $droneBees);
    }

    public function getQueen(): QueenBee
    {
        return $this->queenBee;
    }

    public function noOfQueenBees(): int
    {
        return $this->beeSwarm->getNoOfQueenBees();
    }

    public function noOfWorkerBees(): int
    {
        return $this->beeSwarm->getNoOfWorkerBees();
    }

    public function noOfDroneBees(): int
    {
        return $this->beeSwarm->getNoOfDroneBees();
    }

    public function hitQueenBee()
    {
        $this->queenBee->hit();
    }

    public function hitRandomBee()
    {
        $randomBee = $this->getRandomLiveBee();
        $randomBee->hit();
        $this->ifQueenBeeIsDeadThenKillAllOtherBees();
        $this->lastBeeHit = $randomBee;
    }

    public function getBeeSwarm(): BeeSwarm
    {
        return $this->beeSwarm;
    }

    public function getReportingDetails(): array
    {
        return [
            'bee-name' => $this->lastBeeHit->getName(),
            'remaining-hit-points' => $this->lastBeeHit->getRemainingHitPoints(),
            'no-of-queen-bees' => $this->beeSwarm->getNoOfQueenBees(),
            'no-of-worker-bees' => $this->beeSwarm->getNoOfWorkerBees(),
            'no-of-drone-bees' => $this->beeSwarm->getNoOfDroneBees(),
        ];
    }

    private function ifQueenBeeIsDeadThenKillAllOtherBees()
    {
        if (!$this->queenBee->isAlive()) {
            foreach ($this->beeSwarm->getAllBees() as $bee) {
                $bee->kill();
            }
        }
    }

    private function getRandomLiveBee(): Bee
    {
        return $this->beeSwarm->getRandomLiveBee();
    }

    public function allBeesAreDead(): bool
    {
        return $this->beeSwarm->allBeesAreDead();
    }
}

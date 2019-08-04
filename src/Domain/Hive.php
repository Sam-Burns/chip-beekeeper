<?php
namespace ChipBeekeeper\Domain;

class Hive
{
    /** @var QueenBee */
    private $queenBee;

    /** @var WorkerBee[] */
    private $workerBees;

    /** @var DroneBee[] */
    private $droneBees;

    public function __construct()
    {
        $this->queenBee = QueenBee::newWithFullLifespan();
        for ($beeNo = 1; $beeNo <= 5; $beeNo++) {
            $this->workerBees[] = WorkerBee::newWithFullLifespan();
        }
        for ($beeNo = 1; $beeNo <= 8; $beeNo++) {
            $this->droneBees[] = DroneBee::newWithFullLifespan();
        }
    }

    public function getQueen(): QueenBee
    {
        return $this->queenBee;
    }

    public function noOfQueenBees(): int
    {
        return $this->queenBee->isAlive() ? 1 : 0;
    }

    /**
     * @param Bee[] $bees
     * @return Bee[]
     */
    private function filterForLiveBees(array $bees): array
    {
        return array_filter(
            $bees,
            function (Bee $bee): bool {
                return $bee->isAlive();
            }
        );
    }

    public function noOfWorkerBees(): int
    {
        $liveWorkerBees = $this->filterForLiveBees($this->workerBees);
        return count($liveWorkerBees);
    }

    public function noOfDroneBees(): int
    {
        $liveDroneBees = $this->filterForLiveBees($this->droneBees);
        return count($liveDroneBees);
    }

    public function hitQueenBee()
    {
        $this->queenBee->hit();
    }

    public function hitRandomBee(): ?Bee
    {
        if ($this->allBeesAreDead()) {
            return null;
        }
        $randomBee = $this->getRandomLiveBee();
        $randomBee->hit();
        $this->ifQueenBeeIsDeadThenKillAllOtherBees();
        return $randomBee;
    }

    private function ifQueenBeeIsDeadThenKillAllOtherBees()
    {
        if (!$this->queenBee->isAlive()) {
            foreach ($this->workerBees + $this->droneBees as $bee) {
                $bee->kill();
            }
        }
    }

    /**
     * @return Bee[]
     */
    private function getAllBees(): array
    {
        return array_merge([$this->queenBee], $this->workerBees, $this->droneBees);
    }

    private function getRandomLiveBee(): Bee
    {
        $allBees = $this->getAllBees();
        $allLiveBees = $this->filterForLiveBees($allBees);
        return $allLiveBees[array_rand($allLiveBees)];
    }

    public function allBeesAreDead(): bool
    {
        $liveBees = $this->filterForLiveBees($this->getAllBees());
        return count($liveBees) === 0;
    }

    public function noOfDamagedBees(): int
    {
        $damagedBees = array_filter(
            $this->getAllBees(),
            function (Bee $bee): bool {
                return $bee->isDamaged();
            }
        );
        return count($damagedBees);
    }
}

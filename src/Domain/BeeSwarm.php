<?php
namespace ChipBeekeeper\Domain;

class BeeSwarm
{
    /** @var QueenBee[] */
    private $queenBees;

    /** @var WorkerBee[] */
    private $workerBees;

    /** @var DroneBee[] */
    private $droneBees;

    /** @var Bee[] */
    private $allBees;

    /**
     * @param QueenBee[]  $queenBees
     * @param WorkerBee[] $workerBees
     * @param DroneBee[]  $droneBees
     */
    public function __construct(array $queenBees, array $workerBees, array $droneBees)
    {
        $this->queenBees = $queenBees;
        $this->workerBees = $workerBees;
        $this->droneBees = $droneBees;
        $this->allBees = array_merge($queenBees, $workerBees, $droneBees);
    }

    public function getRandomLiveBee(): Bee
    {
        if ($this->allBeesAreDead()) {
            throw new AllBeesDeadException();
        }
        $allLiveBees = $this->filterForLiveBees($this->allBees);
        return $allLiveBees[array_rand($allLiveBees)];
    }

    /**
     * @return Bee[]
     */
    public function getAllBees(): array
    {
        return $this->allBees;
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

    public function getNoOfQueenBees(): int
    {
        return count($this->filterForLiveBees($this->queenBees));
    }

    public function getNoOfWorkerBees(): int
    {
        return count($this->filterForLiveBees($this->workerBees));
    }

    public function getNoOfDroneBees(): int
    {
        return count($this->filterForLiveBees($this->droneBees));
    }

    public function allBeesAreDead(): bool
    {
        $liveBees = $this->filterForLiveBees($this->allBees);
        return count($liveBees) === 0;
    }
}

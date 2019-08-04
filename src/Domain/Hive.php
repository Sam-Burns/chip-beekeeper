<?php

namespace ChipBeekeeper\Domain;

class Hive
{
    private const INITIAL_NO_OF_QUEEN_BEES = 1;
    private const INITIAL_NO_OF_WORKER_BEES = 5;
    private const INITIAL_NO_OF_DRONE_BEES = 8;

    private $bees = [
        'queen-bees' => [],
        'worker-bees' => [],
        'drone-bees' => [],
    ];

    public function __construct()
    {
        for ($beeNo = 1; $beeNo <= static::INITIAL_NO_OF_QUEEN_BEES; $beeNo++) {
            $this->bees['queen-bees'][] = QueenBee::newWithFullLifespan();
        }
        for ($beeNo = 1; $beeNo <= static::INITIAL_NO_OF_WORKER_BEES; $beeNo++) {
            $this->bees['worker-bees'][] = WorkerBee::newWithFullLifespan();
        }
        for ($beeNo = 1; $beeNo <= static::INITIAL_NO_OF_DRONE_BEES; $beeNo++) {
            $this->bees['drone-bees'][] = DroneBee::newWithFullLifespan();
        }
    }

    public function getQueen(): QueenBee
    {
        return $this->bees['queen-bees'][0];
    }

    public function noOfQueenBees(): int
    {
        $liveBees = array_filter(
            $this->bees['queen-bees'],
            function (Bee $bee): bool {
                return $bee->isAlive();
            }
        );
        return count($liveBees);
    }

    public function noOfWorkerBees(): int
    {
        $liveBees = array_filter(
            $this->bees['worker-bees'],
            function (Bee $bee): bool {
                return $bee->isAlive();
            }
        );
        return count($liveBees);
    }

    public function noOfDroneBees(): int
    {
        $liveBees = array_filter(
            $this->bees['drone-bees'],
            function (Bee $bee): bool {
                return $bee->isAlive();
            }
        );
        return count($liveBees);
    }

    public function hitQueenBee()
    {
        $this->getQueen()->hit();
    }

    public function hitRandomBee()
    {
        if ($this->allBeesAreDead()) {
            return;
        }
        $randomBee = $this->getRandomLiveBee();
        $randomBee->hit();
        if ($randomBee instanceof QueenBee && !$randomBee->isAlive()) {
            foreach ($this->bees['worker-bees'] as $workerBee) {
                $workerBee->kill();
            }
            foreach ($this->bees['drone-bees'] as $droneBee) {
                $droneBee->kill();
            }
        }
    }

    private function getRandomLiveBee(): Bee
    {
        $allBees = $this->bees['queen-bees'] + $this->bees['worker-bees'] + $this->bees['drone-bees'];

        $allLiveBees = array_filter(
            $allBees,
            function (Bee $bee): bool {
                return $bee->isAlive();
            }
        );

        return $allLiveBees[array_rand($allLiveBees)];
    }

    public function allBeesAreDead(): bool
    {
        foreach ($this->bees['queen-bees'] as $bee) {
            if ($bee->isAlive()) {
                return false;
            }
        }
        foreach ($this->bees['worker-bees'] as $bee) {
            if ($bee->isAlive()) {
                return false;
            }
        }
        foreach ($this->bees['drone-bees'] as $bee) {
            if ($bee->isAlive()) {
                return false;
            }
        }
        return true;
    }

    public function noOfDamagedBees(): int
    {
        $noOfDamagedBees = 0;
        foreach ($this->bees['queen-bees'] as $bee) {
            if ($bee->isDamaged()) {
                ++$noOfDamagedBees;
            }
        }
        foreach ($this->bees['worker-bees'] as $bee) {
            if ($bee->isDamaged()) {
                ++$noOfDamagedBees;
            }
        }
        foreach ($this->bees['drone-bees'] as $bee) {
            if ($bee->isDamaged()) {
                ++$noOfDamagedBees;
            }
        }
        return $noOfDamagedBees;
    }
}

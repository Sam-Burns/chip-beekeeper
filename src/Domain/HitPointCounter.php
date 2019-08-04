<?php

namespace ChipBeekeeper\Domain;

class HitPointCounter
{
    private $remainingHitPoints;

    public function __construct(int $initialHitPoints)
    {
        $this->remainingHitPoints = $initialHitPoints;
    }

    public function getRemainingHitPoints(): int
    {
        return $this->remainingHitPoints;
    }

    public function deduct(int $hitPointsToDeduct)
    {
        $this->remainingHitPoints -= $hitPointsToDeduct;
        if ($this->remainingHitPoints < 0) {
            $this->remainingHitPoints = 0;
        }
    }

    public function hasRunOutOfHitPoints(): bool
    {
        return $this->remainingHitPoints === 0;
    }
}

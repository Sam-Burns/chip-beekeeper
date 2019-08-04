<?php
namespace ChipBeekeeper\Domain;

class QueenBee
{
    private $hitPoints;

    private function __construct(int $hitPoints)
    {
        $this->hitPoints = $hitPoints;
    }

    public static function newWithRemainingHitPoints(int $remainingHitPoints)
    {
        $queenBee = new QueenBee($remainingHitPoints);
        return $queenBee;
    }

    public static function newWithFullLifespan(): self
    {
        return new QueenBee(100);
    }

    public function getRemainingHitPoints(): int
    {
        return $this->hitPoints;
    }

    public function hit()
    {
        $this->hitPoints -= 8;
        if ($this->hitPoints < 0) {
            $this->hitPoints = 0;
        }
    }

    public function isAlive(): bool
    {
        return $this->hitPoints > 0;
    }
}

<?php
namespace ChipBeekeeper\Domain;

class QueenBee
{
    private $hitPoints;

    private function __construct(int $hitPoints)
    {
        $this->hitPoints = $hitPoints;
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
    }
}

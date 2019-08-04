<?php
namespace ChipBeekeeper\Domain;

class QueenBee
{
    private $hitPointCounter;

    private function __construct(HitPointCounter $hitPointCounter)
    {
        $this->hitPointCounter = $hitPointCounter;
    }

    public static function newWithRemainingHitPoints(int $remainingHitPoints)
    {
        return new QueenBee(new HitPointCounter($remainingHitPoints));
    }

    public static function newWithFullLifespan(): self
    {
        return new QueenBee(new HitPointCounter(100));
    }

    public function getRemainingHitPoints(): int
    {
        return $this->hitPointCounter->getRemainingHitPoints();
    }

    public function hit()
    {
        $this->hitPointCounter->deduct(8);
    }

    public function isAlive(): bool
    {
        return !$this->hitPointCounter->hasRunOutOfHitPoints();
    }
}

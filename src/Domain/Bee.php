<?php
namespace ChipBeekeeper\Domain;

abstract class Bee
{
    protected const NAME = '';
    protected const FULL_LIFESPAN = -1;
    protected const HIT_POINTS_LOST_FROM_ONE_HIT = -1;

    private $hitPointCounter;

    private function __construct(HitPointCounter $hitPointCounter)
    {
        $this->hitPointCounter = $hitPointCounter;
    }

    public static function newWithRemainingHitPoints(int $remainingHitPoints)
    {
        return new static(new HitPointCounter($remainingHitPoints));
    }

    public static function newWithFullLifespan(): self
    {
        return new static(new HitPointCounter(static::FULL_LIFESPAN));
    }

    public function getRemainingHitPoints(): int
    {
        return $this->hitPointCounter->getRemainingHitPoints();
    }

    public function hit()
    {
        $this->hitPointCounter->deduct(static::HIT_POINTS_LOST_FROM_ONE_HIT);
    }

    public function isAlive(): bool
    {
        return !$this->hitPointCounter->hasRunOutOfHitPoints();
    }

    public function isDamaged(): bool
    {
        return $this->hitPointCounter->getRemainingHitPoints() < static::FULL_LIFESPAN;
    }

    public function kill()
    {
        while ($this->isAlive()) {
            $this->hit();
        }
    }

    public function getName(): string
    {
        return static::NAME;
    }
}

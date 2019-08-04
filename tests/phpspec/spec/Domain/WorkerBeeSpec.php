<?php

namespace spec\ChipBeekeeper\Domain;

use ChipBeekeeper\Domain\WorkerBee;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class WorkerBeeSpec extends ObjectBehavior
{
    function it_is_initialised_with_75_hit_points()
    {
        $this->beConstructedThrough('newWithFullLifespan');
        $this->getRemainingHitPoints()->shouldBe(75);
    }

    function it_loses_10_hit_points_when_hit()
    {
        $this->beConstructedThrough('newWithFullLifespan');
        $this->hit();
        $this->getRemainingHitPoints()->shouldBe(65);
    }
}

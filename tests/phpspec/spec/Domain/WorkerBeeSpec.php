<?php

namespace spec\ChipBeekeeper\Domain;

use PhpSpec\ObjectBehavior;

class WorkerBeeSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedThrough('newWithFullLifespan');
    }

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

    function it_can_be_killed()
    {
        $this->isAlive()->shouldBe(true);
        $this->kill();
        $this->isAlive()->shouldBe(false);
    }
}

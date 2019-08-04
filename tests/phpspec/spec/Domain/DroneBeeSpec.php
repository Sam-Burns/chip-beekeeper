<?php
namespace spec\ChipBeekeeper\Domain;

use PhpSpec\ObjectBehavior;

class DroneBeeSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedThrough('newWithFullLifespan');
    }

    function it_is_initialised_with_50_hit_points()
    {
        $this->beConstructedThrough('newWithFullLifespan');
        $this->getRemainingHitPoints()->shouldBe(50);
    }

    function it_loses_12_hit_points_when_hit()
    {
        $this->beConstructedThrough('newWithFullLifespan');
        $this->hit();
        $this->getRemainingHitPoints()->shouldBe(38);
    }
}

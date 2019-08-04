<?php
namespace spec\ChipBeekeeper\Domain;

use PhpSpec\ObjectBehavior;

class QueenBeeSpec extends ObjectBehavior
{
    function it_is_initialised_with_100_hit_points()
    {
        $this->beConstructedThrough('newWithFullLifespan');
        $this->getRemainingHitPoints()->shouldBe(100);
    }

    function it_loses_8_hit_points_when_hit()
    {
        $this->beConstructedThrough('newWithFullLifespan');
        $this->hit();
        $this->getRemainingHitPoints()->shouldBe(92);
    }
}

<?php
namespace spec\ChipBeekeeper\Domain;

use PhpSpec\ObjectBehavior;

class QueenBeeSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedThrough('newWithFullLifespan');
    }

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

    function it_can_be_initialised_with_arbitrary_remaining_hit_points()
    {
        $this->beConstructedThrough('newWithRemainingHitPoints', [4]);
        $this->getRemainingHitPoints()->shouldBe(4);
    }

    function it_does_not_let_hit_points_underflow()
    {
        $this->beConstructedThrough('newWithRemainingHitPoints', [4]);
        $this->hit();
        $this->getRemainingHitPoints()->shouldBe(0);
    }

    function it_is_not_alive_after_final_hit()
    {
        $this->beConstructedThrough('newWithRemainingHitPoints', [4]);
        $this->hit();
        $this->isAlive()->shouldBe(false);
    }

    function it_knows_if_it_is_damaged()
    {
        $this->isDamaged()->shouldBe(false);
        $this->hit();
        $this->isDamaged()->shouldBe(true);
    }
}

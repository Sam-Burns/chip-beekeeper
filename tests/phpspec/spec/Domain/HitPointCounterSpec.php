<?php

namespace spec\ChipBeekeeper\Domain;

use PhpSpec\ObjectBehavior;

class HitPointCounterSpec extends ObjectBehavior
{
    function it_can_be_initialised_with_a_numerical_value()
    {
        $this->beConstructedWith(10);
        $this->getRemainingHitPoints()->shouldBe(10);
    }

    function it_can_be_reduced_by_a_given_amount()
    {
        $this->beConstructedWith(10);
        $this->deduct(4);
        $this->getRemainingHitPoints()->shouldBe(6);
    }

    function it_doesnt_underflow()
    {
        $this->beConstructedWith(10);
        $this->deduct(20);
        $this->getRemainingHitPoints()->shouldBe(0);
    }

    function it_can_tell_you_if_there_are_no_more_points()
    {
        $this->beConstructedWith(10);
        $this->hasRunOutOfHitPoints()->shouldBe(false);
        $this->deduct(10);
        $this->hasRunOutOfHitPoints()->shouldBe(true);
    }
}

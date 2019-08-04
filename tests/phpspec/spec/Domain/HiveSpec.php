<?php
namespace spec\ChipBeekeeper\Domain;

use ChipBeekeeper\Domain\AllBeesDeadException;
use ChipBeekeeper\Domain\Hive;
use ChipBeekeeper\Domain\QueenBee;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/** @mixin Hive */
class HiveSpec extends ObjectBehavior
{
    function it_is_initialised_with_the_right_population()
    {
        $this->noOfQueenBees()->shouldBe(1);
        $this->noOfWorkerBees()->shouldBe(5);
        $this->noOfDroneBees()->shouldBe(8);
    }

    function it_allows_a_direct_hit_on_the_queen()
    {
        $this->hitQueenBee();
        $this->getQueen()->isDamaged()->shouldBe(true);
    }

    function it_allowsRandomBeesToBeHit()
    {
        $this->noOfQueenBees()->shouldBe(1);
        $this->noOfWorkerBees()->shouldBe(5);
        $this->noOfDroneBees()->shouldBe(8);

        for ($noOfHits = 1; $noOfHits <= 93; $noOfHits++) {
            try {
                $this->hitRandomBee();
            } catch (AllBeesDeadException $e) {}
        }

        $this->noOfQueenBees()->shouldBe(0);
        $this->noOfWorkerBees()->shouldBe(0);
        $this->noOfDroneBees()->shouldBe(0);
    }

    function it_knows_when_all_bees_are_dead()
    {
        $this->allBeesAreDead()->shouldBe(false);

        for ($noOfHits = 1; $noOfHits <= 93; $noOfHits++) {
            try {
                $this->hitRandomBee();
            } catch (AllBeesDeadException $e) {}
        }

        $this->allBeesAreDead()->shouldBe(true);
    }

    function it_can_return_the_queen()
    {
        $this->getQueen()->shouldHaveType(QueenBee::class);
    }
}

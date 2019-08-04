<?php
namespace ChipBeekeeper\Domain;

class QueenBee extends Bee
{
    protected const NAME = 'Queen Bee';
    protected const FULL_LIFESPAN = 100;
    protected const HIT_POINTS_LOST_FROM_ONE_HIT = 8;
}

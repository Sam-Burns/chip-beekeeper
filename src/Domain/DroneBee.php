<?php
namespace ChipBeekeeper\Domain;

class DroneBee extends Bee
{
    protected const NAME = 'Drone Bee';
    protected const FULL_LIFESPAN = 50;
    protected const HIT_POINTS_LOST_FROM_ONE_HIT = 12;
}

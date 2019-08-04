<?php
namespace ChipBeekeeper\Domain;

class WorkerBee extends Bee
{
    protected const NAME = 'Worker Bee';
    protected const FULL_LIFESPAN = 75;
    protected const HIT_POINTS_LOST_FROM_ONE_HIT = 10;
}

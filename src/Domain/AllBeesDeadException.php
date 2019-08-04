<?php
namespace ChipBeekeeper\Domain;

use Throwable;

class AllBeesDeadException extends \Exception
{
    public function __construct()
    {
        parent::__construct('Cannot select a live bee');
    }
}

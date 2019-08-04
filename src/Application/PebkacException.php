<?php
namespace ChipBeekeeper\Application;

use Throwable;

class PebkacException extends \Exception
{
    public function __construct()
    {
        parent::__construct("You typed something other than the word 'hit'");
    }
}

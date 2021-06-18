<?php


namespace Pebblip;

class StoneNotFoundException extends \Exception
{
    public function __construct(Position $position)
    {
        parent::__construct("stone not found at {$position}");
    }
}

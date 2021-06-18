<?php


namespace Pebblip;

class StoneExistsException extends \Exception
{
    public function __construct(Position $position)
    {
        parent::__construct("already exists stone at {$position}");
    }
}

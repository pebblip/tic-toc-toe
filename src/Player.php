<?php


namespace Pebblip;


interface Player
{
    /**
     * @param Board $board
     *
     * @return Position
     */
    public function nextPosition(Board $board): Position;

    /**
     * @return Stone
     */
    public function stone() : Stone;
}

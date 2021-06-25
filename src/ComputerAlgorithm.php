<?php


namespace Pebblip;


interface ComputerAlgorithm
{
    /**
     * @param Board $board
     * @param Stone $stone
     *
     * @return Position
     */
    public function nextPosition(Board $board, Stone $stone): Position;
}

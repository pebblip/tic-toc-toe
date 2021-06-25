<?php

namespace Pebblip\Algorithm;

use Pebblip\Board;
use Pebblip\ComputerAlgorithm;
use Pebblip\Position;
use Pebblip\Stone;

class SequentialAlgorithm implements ComputerAlgorithm
{
    public function nextPosition(Board $board, Stone $stone): Position
    {
        $emptyPositions = array_filter($board->positions(), function (Position $position) use ($board) {
            return $board->isEmpty($position);
        });

        if (empty($emptyPositions)) {
            throw new \RuntimeException('Not found next position');
        }

        return $emptyPositions[0];
    }
}

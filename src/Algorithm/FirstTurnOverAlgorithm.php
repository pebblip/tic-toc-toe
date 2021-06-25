<?php

namespace Pebblip\Algorithm;

use Pebblip\Board;
use Pebblip\ComputerAlgorithm;
use Pebblip\Position;
use Pebblip\Stone;

class FirstTurnOverAlgorithm implements ComputerAlgorithm
{
    public function nextPosition(Board $board, Stone $stone): Position
    {
        $emptyPositions = array_filter($board->positions(), function (Position $position) use ($board) {
            return $board->isEmpty($position);
        });

        if (empty($emptyPositions)) {
            throw new \RuntimeException('Not found next position');
        }

        foreach ($emptyPositions as $position) {
            if ($board->numberTurnedOver($position, $stone) > 0) {
                return $position;
            }
        }

        return array_shift($emptyPositions);
    }
}

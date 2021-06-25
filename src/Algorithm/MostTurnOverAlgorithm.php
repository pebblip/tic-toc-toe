<?php

namespace Pebblip\Algorithm;

use Pebblip\Board;
use Pebblip\ComputerAlgorithm;
use Pebblip\Position;
use Pebblip\Stone;

class MostTurnOverAlgorithm implements ComputerAlgorithm
{
    public function nextPosition(Board $board, Stone $stone): Position
    {
        $emptyPositions = array_filter($board->positions(), function (Position $position) use ($board) {
            return $board->isEmpty($position);
        });

        if (empty($emptyPositions)) {
            throw new \RuntimeException('Not found next position');
        }

        $maxNumber = 0;
        $maxPosition = null;

        foreach ($emptyPositions as $position) {
            $numberTurnedOver = $board->numberTurnedOver($position, $stone);
            if ($maxNumber <= $numberTurnedOver) {
                $maxNumber = $numberTurnedOver;
                $maxPosition = $position;
            }
        }

        if ($maxNumber === 0) {
            return array_shift($emptyPositions);
        }

        return $maxPosition;
    }
}

<?php


namespace Pebblip\Algorithm;

use Pebblip\Position;
use Pebblip\Board;
use Pebblip\ComputerAlgorithm;
use Pebblip\Stone;

class RandomAlgorithm implements ComputerAlgorithm
{
    /**
     * @param Board $board
     * @param Stone $stone
     *
     * @return Position
     */
    public function nextPosition(Board $board, Stone $stone): Position
    {
        $boardSize = $board->size();

        $x = $this->random($boardSize);
        $y = $this->random($boardSize);

        $nextPosition = new Position($x, $y);

        if ($board->isEmpty($nextPosition)) {
            return $nextPosition;
        }

        return $this->nextPosition($board, $stone);
    }


    private function random(int $size) : int {
        try {
            return random_int(1, $size);
        } catch (\Exception $e) {
            throw new \RuntimeException('Failed to get next position.');
        }
    }
}

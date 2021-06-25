<?php


namespace Pebblip;


class ComputerPlayer implements Player
{
    private Stone $stone;
    private ComputerAlgorithm $algorithm;
    private int $sleep;

    /**
     * ComputerPlayer constructor.
     *
     * @param Stone $stone
     * @param ComputerAlgorithm $algorithm
     * @param int $sleep
     */
    public function __construct(
        Stone $stone,
        ComputerAlgorithm $algorithm,
        int $sleep = 0
    ) {
        $this->stone = $stone;
        $this->algorithm = $algorithm;
        $this->sleep = $sleep;
    }


    public function nextPosition(Board $board): Position
    {
        sleep($this->sleep);
        return $this->algorithm->nextPosition($board, $this->stone());
    }

    public function stone(): Stone
    {
        return $this->stone;
    }
}

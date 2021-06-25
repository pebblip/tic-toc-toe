<?php


namespace Pebblip;


use Exception;

class HumanPlayer implements Player
{

    /**
     * @var Stone
     */
    private Stone $stone;

    /**
     * @var resource
     */
    private $in;

    /**
     * @var resource
     */
    private $out;

    /**
     * HumanPlayer constructor.
     *
     * @param Stone $stone
     * @param       $in
     * @param       $out
     */
    public function __construct(Stone $stone, $in, $out)
    {
        $this->stone = $stone;
        $this->in = $in;
        $this->out = $out;
    }

    public function nextPosition(Board $board): Position
    {
        $position = $this->tryGetNextPosition();
        if ($position !== null) {
            return $position;
        }

        fwrite($this->out, "SOMETHING WRONG\n");
        return $this->nextPosition($board);
    }

    /**
     * @return Stone
     */
    public function stone(): Stone
    {
        return $this->stone;
    }

    private function tryGetNextPosition(): ?Position
    {
        try {
            fwrite($this->out, 'enter (x,y) to put stone: ');
            $input = fgets($this->in);

            $positions = explode(',', trim($input));
            if (count($positions) !== 2) {
                return null;
            }
            if (!is_numeric($positions[0]) || !is_numeric($positions[0])) {
                return null;
            }
            return new Position($positions[0], $positions[1]);
        } catch (Exception $e) {
            return null;
        }
    }
}

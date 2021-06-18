<?php


namespace Pebblip;

/**
 * ゲーム盤。
 *
 * @package Pebblip
 */
class Board
{
    /**
     * @var int
     */
    private int $size;

    /**
     * @var Cell[]
     */
    private array $cells = [];

    /**
     * Board constructor.
     *
     * @param int   $size
     * @param array $cells
     */
    private function __construct(int $size, array $cells) {
        $this->size = $size;
        $this->cells = $cells;

        foreach ($cells as $cell) {
            foreach(Direction::all() as $direction) {
                $neighborCell = $this->atCell($cell->position()->next($direction));
                if ($neighborCell !== null) {
                    $cell->setNeighbor($direction, $neighborCell);
                }
            }
        }
    }

    /**
     * ゲーム盤を生成します。
     *
     * @param int $size
     *
     * @return Board
     */
    public static function make(int $size) : Board {
        $cells = [];
        foreach (range(1, $size) as $x) {
            foreach (range(1, $size) as $y) {
                $position = new Position($x, $y);
                $cells[] = new Cell($position);
            }
        }

        return new Board($size, $cells);
    }

    /**
     * 指定した位置の石を返します。
     * @param Position $position
     *
     * @return Stone|null
     */
    public function get(Position $position): ?Stone
    {
        $cell = $this->atCell($position);

        return $cell->stone();
    }

    /**
     * 指定した位置に石を置きます。
     * @param Position $position
     * @param Stone    $stone
     *
     * @throws StoneExistsException
     */
    public function put(Position $position, Stone $stone)
    {
        $cell = $this->atCell($position);
        $cell->putStone($stone);

        //石をひっくり返す
        $this->flip($position);
    }

    /**
     * @param Position $position
     *
     * @return bool
     */
    public function isEmpty(Position $position) : bool {
        $cell = $this->atCell($position);

        return $cell !== null && !$cell->hasStone();
    }

    /**
     * 起点となる位置からすべての可能な石をひっくり返す。
     *
     * @param Position $position 起点となる位置
     */
    private function flip(Position $position)
    {
        $cell = $this->atCell($position);

        foreach (Direction::all() as $direction) {
            $collects = $this->collectCellsToTurn($cell->neighbor($direction),
                $cell->stone()->turn(), $direction, []);

            foreach ($collects as $collect) {
                $collect->turn();
            }
        }
    }

    /**
     * @param ?Cell $cell
     * @param Stone $stone
     * @param Direction $direction
     * @param Cell[] $cells
     *
     * @return Cell[]
     */
    private function collectCellsToTurn(
        ?Cell $cell,
        Stone $stone,
        Direction $direction,
        array $cells
    ): array {
        if ($cell === null || !$cell->hasStone()) {
            return [];
        }

        if ($cell->stone()->eq($stone->turn())) {
            return $cells;
        }

        return $this->collectCellsToTurn($cell->neighbor($direction), $stone, $direction,
            array_merge([$cell], $cells));
    }

    private function atCell(Position $position): ?Cell
    {
        foreach ($this->cells as $cell) {
            if ($cell->position()->eq($position)) {
                return $cell;
            }
        }
        return null;
    }

    public function toString() : string {
        $board = '';
        foreach (range(1, $this->size) as $y) {
            foreach (range(1, $this->size) as $x) {
                $stone = $this->get(new Position($x, $y));

                if ($stone === null) {
                    $board .= '-';
                }
                else {
                    $board .= $stone;
                }
            }
            $board .= "\n";
        }
        return $board;
    }
}

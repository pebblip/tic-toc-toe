<?php


namespace Pebblip;

/**
 * ゲーム盤の１セルを表します。
 */
class Cell
{
    /**
     * このセルの位置
     * @var Position
     */
    private Position $position;

    /**
     * セルの石。
     * @var Stone|null
     */
    private ?Stone $stone = null;

    /**
     * 隣接セル。
     *
     * セルがない場合はnull.
     * @var array
     */
    private array $neighbors = [];

    /**
     * Cell constructor.
     *
     * @param Position   $position
     */
    public function __construct(Position $position)
    {
        $this->position = $position;

        foreach (Direction::all() as $direction) {
            $this->neighbors[$direction->code()] = null;
        }
    }

    /**
     * このセルの位置を返します。
     *
     * @return Position
     */
    public function position() : Position {
        return $this->position;
    }

    /**
     * 石を置きます。
     *
     * @param Stone $stone
     *
     * @throws StoneExistsException すでに石が存在する場合
     */
    public function putStone(Stone $stone) {
        if ($this->stone !== null) {
            throw new StoneExistsException($this->position);
        }
        $this->stone = $stone;
    }

    /**
     * 石を反転します。
     *
     * @throws StoneNotFoundException 石が存在しない場合
     */
    public function turn() {
        if ($this->stone === null) {
            throw new StoneNotFoundException($this->position);
        }
        $this->stone = $this->stone->turn();
    }

    /**
     * 石を返します。
     *
     * @return Stone|null
     */
    public function stone() : ?Stone {
        return $this->stone;
    }

    /**
     * 石があればtrueを返します。
     *
     * @return bool
     */
    public function hasStone() : bool {
        return $this->stone !== null;
    }

    /**
     * 隣接セルを設定します。
     *
     * @param Direction $direction
     * @param Cell      $cell
     */
    public function setNeighbor(Direction $direction, Cell $cell) {
        $this->neighbors[$direction->code()] = $cell;

        if (!$cell->hasNeighbor($direction->opposite())) {
            $cell->setNeighbor($direction->opposite(), $this);
        }

        if (!$cell->neighbor($direction->opposite())->eq($this)) {
            $cell->setNeighbor($direction->opposite(), $this);
        }
    }

    /**
     * 隣接セルがあればtrueを返します。
     *
     * @param Direction $direction
     *
     * @return bool
     */
    public function hasNeighbor(Direction $direction) : bool {
        return $this->neighbors[$direction->code()] !== null;
    }

    /**
     * @return Cell[]
     */
    public function neighbors() : array {
        return array_map(
            function (Direction $direction) {
                return $this->neighbor($direction);
            },
            array_filter(Direction::all(), function (Direction $direction) {
                return $this->hasNeighbor($direction);
            })
        );
    }

    /**
     * 隣接セルを返します。
     *
     * @param Direction $direction
     *
     * @return ?Cell
     */
    public function neighbor(Direction $direction) : ?Cell {
        return $this->neighbors[$direction->code()];
    }

    /**
     * 指定した方向への全てのセル（自分を含む）を返します。
     *
     * @param Direction $direction
     *
     * @return Cell[]
     */
    public function cellsToEdge(Direction $direction) : array {
        if (!$this->hasNeighbor($direction)) {
            return [$this];
        }

        $cells = $this->neighbor($direction)->cellsToEdge($direction);

        return array_merge([$this], $cells);
    }

    /**
     * @param Cell $other
     *
     * @return bool
     */
    public function eq(Cell $other) : bool {
        return $this->position()->eq($other->position());
    }
}

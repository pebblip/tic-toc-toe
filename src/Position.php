<?php

namespace Pebblip;

use RuntimeException;

/**
 * (x,y)座標からなる位置を表します。
 *
 * 座標系は左上を(1,1)をみなします。
 */
class Position
{
    /**
     * @var int
     */
    private int $x;

    /**
     * @var int
     */
    private int $y;

    /**
     * Position constructor.
     *
     * @param int $x
     * @param int $y
     */
    public function __construct(int $x, int $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    /**
     * @return int x座標
     */
    public function x() : int
    {
        return $this->x;
    }

    /**
     * @return int y座標
     */
    public function y() : int
    {
        return $this->y;
    }

    /**
     * 隣接する座標を返します。
     * @param Direction $direction
     *
     * @return Position
     */
    public function next(Direction $direction): Position
    {
        switch ($direction) {
            case Direction::T():
                return new Position($this->x(), $this->y() - 1);
            case Direction::R():
                return new Position($this->x() + 1, $this->y());
            case Direction::B():
                return new Position($this->x(), $this->y() + 1);
            case Direction::L():
                return new Position($this->x() - 1, $this->y());
            case Direction::TR():
                return new Position($this->x() + 1, $this->y() - 1);
            case Direction::BR():
                return new Position($this->x() + 1, $this->y() + 1);
            case Direction::BL():
                return new Position($this->x() - 1, $this->y() + 1);
            case Direction::TL():
                return new Position($this->x() - 1, $this->y() - 1);
            default: throw new RuntimeException(); //ありえない
        }
    }

    /**
     * @param Position $other
     *
     * @return bool
     */
    public function eq(Position $other) : bool {
        return $this->x() === $other->x() && $this->y() === $other->y();
    }

    public function __toString(): string
    {
        return "({$this->x}, {$this->y})";
    }
}

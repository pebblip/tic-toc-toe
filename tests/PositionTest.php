<?php

namespace Pebblip;

use PHPUnit\Framework\TestCase;

class PositionTest extends TestCase
{
    /**
     * @test
     * @dataProvider eqCases
     */
    public function 比較できる(Position $position, Position $other, bool $expected) {
        $this->assertEquals($expected, $position->eq($other));
    }

    /**
     * @test
     * @dataProvider nextCases
     */
    public function 隣接座標を取得できる(Position $position, Direction $direction, Position $expected)
    {
        $actual = $position->next($direction);

        $this->assertEquals($expected, $actual);
    }


    public function nextCases()
    {
        return [
            [
                new Position(0,0), Direction::T(), new Position(0,-1),
                new Position(0,0), Direction::R(), new Position(1,0),
                new Position(0,0), Direction::B(), new Position(0,1),
                new Position(0,0), Direction::L(), new Position(-1,0),
                new Position(0,0), Direction::TR(), new Position(1,-1),
                new Position(0,0), Direction::BR(), new Position(1,1),
                new Position(0,0), Direction::BL(), new Position(-1,1),
                new Position(0,0), Direction::TL(), new Position(-1,-1),
            ]
        ];
    }

    public function eqCases()
    {
        return [
            [new Position(0,0), new Position(0,0), true],
            [new Position(0,0), new Position(1,0), false],
            [new Position(0,0), new Position(1,1), false],
            [new Position(1,1), new Position(1,1), true],
        ];
    }
}

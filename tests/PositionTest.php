<?php

namespace Pebblip;

use phpDocumentor\Reflection\Location;
use PHPUnit\Framework\TestCase;

class PositionTest extends TestCase
{

    /**
     * @test
     * @dataProvider nextCasese
     */
    public function 隣接座標を取得できる(Position $position, Direction $direction, Position $expected)
    {
        $actual = $position->next($direction);

        $this->assertEquals($expected, $actual);
    }


    public function nextCasese()
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
}

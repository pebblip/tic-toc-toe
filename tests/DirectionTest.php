<?php

namespace Pebblip;

use PHPUnit\Framework\TestCase;

class DirectionTest extends TestCase
{
    /**
     * @test
     * @dataProvider oppositeCases
     */
    public function 逆方向を取得できる(Direction $direction, Direction $expected) {
        $this->assertEquals($expected, $direction->opposite());
    }

    public function oppositeCases()
    {
        return [
            [Direction::T(), Direction::B()],
            [Direction::R(), Direction::L()],
            [Direction::B(), Direction::T()],
            [Direction::L(), Direction::R()],
            [Direction::TR(), Direction::BL()],
            [Direction::BR(), Direction::TL()],
            [Direction::BL(), Direction::TR()],
            [Direction::TL(), Direction::BR()],
        ];
    }
}

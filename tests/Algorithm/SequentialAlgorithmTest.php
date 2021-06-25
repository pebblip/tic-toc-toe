<?php

namespace Pebblip\Algorithm;

use Pebblip\Board;
use Pebblip\Position;
use Pebblip\Stone;
use PHPUnit\Framework\TestCase;

class SequentialAlgorithmTest extends TestCase
{
    /**
     * @test
     * @dataProvider cases
     */
    public function 最初の空いている位置を返す(Board $board, Position $expected)
    {
        $sut = new SequentialAlgorithm();

        $actual = $sut->nextPosition($board, Stone::BLACK());

        $this->assertEquals($expected, $actual);
    }

    public function cases()
    {
        return [
            [
                Board::make(3),
                new Position(1, 1),
            ],
            [
                Board::make(3)->put(new Position(1, 2), Stone::BLACK()), new Position(1, 1),
            ],
            [
                Board::make(3)->put(new Position(1, 1), Stone::BLACK()), new Position(2, 1),
            ],
            [
                Board::make(3)
                    ->put(new Position(1, 1), Stone::BLACK())
                    ->put(new Position(2, 1), Stone::BLACK())
                    ->put(new Position(3, 1), Stone::BLACK())
                , new Position(1, 2),
            ],
        ];
    }
}

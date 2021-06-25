<?php

namespace Pebblip\Algorithm;

use Pebblip\Board;
use Pebblip\Position;
use Pebblip\Stone;
use PHPUnit\Framework\TestCase;

class FirstTurnOverAlgorithmTest extends TestCase
{
    /**
     * @test
     * @throws \Pebblip\StoneExistsException
     */
    public function 最初のひっくり返せる位置を返す()
    {
        $sut = new FirstTurnOverAlgorithm();

        //?は次に●が引っくり返すことができるセルの位置を表す。このアルゴリズムは最初の?の位置を返す。
        //  ● ● ○ ? -
        //  - - ○ - -
        //  - - ● ○ ?
        //  - - - - ?
        //  - - - - -
        $board = Board::make(5)
            ->put(new Position(1, 1), Stone::BLACK())
            ->put(new Position(2, 1), Stone::BLACK())
            ->put(new Position(3, 1), Stone::WHITE())
            ->put(new Position(3, 2), Stone::WHITE())
            ->put(new Position(3, 3), Stone::BLACK())
            ->put(new Position(4, 3), Stone::WHITE());

        $actual = $sut->nextPosition($board, Stone::BLACK());

        $this->assertEquals(new Position(4,1), $actual);
    }

    /**
     * @test
     */
    public function 引っくり返せる位置がなければ最初の空き位置を返す() {
        $sut = new FirstTurnOverAlgorithm();

        //?は次に●が引っくり返すことができるセルの位置を表す。このアルゴリズムは最初の?の位置を返す。
        //  ● ○ ● - -
        //  - - ○ - -
        //  - - ● ● -
        //  - - - - -
        $board = Board::make(5)
            ->put(new Position(1, 1), Stone::BLACK())
            ->put(new Position(2, 1), Stone::WHITE())
            ->put(new Position(3, 1), Stone::BLACK())
            ->put(new Position(3, 2), Stone::WHITE())
            ->put(new Position(3, 3), Stone::BLACK())
            ->put(new Position(4, 3), Stone::BLACK());

        $actual = $sut->nextPosition($board, Stone::BLACK());

        $this->assertEquals(new Position(4,1), $actual);
    }
}

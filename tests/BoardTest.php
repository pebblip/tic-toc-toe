<?php


namespace Pebblip;


use PHPUnit\Framework\TestCase;

class BoardTest extends TestCase
{

    /**
     * @test
     */
    public function ボードを生成できる() {
        $board = Board::make(3);

        $this->assertEquals("---\n---\n---\n", $board->toString());
    }
}

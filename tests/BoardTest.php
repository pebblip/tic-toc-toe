<?php


namespace Pebblip;


use PHPUnit\Framework\TestCase;

class BoardTest extends TestCase
{

    private board $sut;

    public function setUp(): void
    {
        parent::setUp();

        $this->sut = Board::make(3);
    }

    /**
     * @test
     */
    public function ボードを生成できる() {
        $this->assertEquals("---\n---\n---\n", $this->sut->toString());
    }

    /**
     * @test
     */
    public function 石を置ける() {
        $position = new Position(1,1);
        $this->sut->put($position, Stone::WHITE());

        $this->assertEquals(Stone::WHITE(),$this->sut->get($position));
    }
}

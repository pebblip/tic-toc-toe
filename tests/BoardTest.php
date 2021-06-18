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
    public function ボードを生成できる()
    {
        $this->assertEquals("---\n---\n---\n", $this->sut->toString());
    }

    /**
     * @test
     * @throws StoneExistsException
     */
    public function 石を置ける()
    {
        $position = new Position(1, 1);
        $this->sut->put($position, Stone::WHITE());

        $this->assertEquals(Stone::WHITE(), $this->sut->get($position));
    }

    /**
     * @test
     * @throws StoneExistsException
     */
    public function すでに石がある場所には石を置けない()
    {
        $position = new Position(1, 1);
        $this->sut->put($position, Stone::WHITE());

        $this->expectException(StoneExistsException::class);
        $this->sut->put($position, Stone::BLACK());
    }
}

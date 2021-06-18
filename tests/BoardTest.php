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

    /**
     * @test
     * @throws StoneExistsException
     */
    public function 石があるか否かを判定できる()
    {
        $position = new Position(1, 1);

        $this->assertTrue($this->sut->isEmpty($position));

        $this->sut->put($position, Stone::WHITE());

        $this->assertFalse($this->sut->isEmpty($position));
    }

    /**
     * @test
     * @throws StoneExistsException
     */
    public function 石を置くと隣接するすべての石をひっくり返す()
    {
        $board = Board::make(4);

        $board->put(new Position(1,1), Stone::BLACK());
        $board->put(new Position(1,2), Stone::WHITE());
        $board->put(new Position(1,3), Stone::WHITE());

        $this->assertEquals(Stone::BLACK(), $board->get(new Position(1,1)));
        $this->assertEquals(Stone::WHITE(), $board->get(new Position(1,2)));
        $this->assertEquals(Stone::WHITE(), $board->get(new Position(1,3)));

        $board->put(new Position(1,4), Stone::BLACK());

        $this->assertEquals(Stone::BLACK(), $board->get(new Position(1,2)));
        $this->assertEquals(Stone::BLACK(), $board->get(new Position(1,3)));
    }
}

<?php

namespace Pebblip;

use PHPUnit\Framework\TestCase;

class CellTest extends TestCase
{

    private Cell $sut;

    public function setUp(): void
    {
        parent::setUp();

        $this->sut = new Cell(new Position(1, 1));
    }

    /**
     * @test
     * @throws StoneExistsException
     */
    public function 石を置ける()
    {
        $this->sut->putStone(Stone::BLACK());

        $this->assertEquals(Stone::BLACK(), $this->sut->stone());
    }

    /**
     * @test
     * @throws StoneExistsException
     */
    public function すでに石がある場所には石を置けない()
    {
        $this->sut->putStone(Stone::BLACK());

        $this->expectException(StoneExistsException::class);

        $this->sut->putStone(Stone::WHITE());
    }

    /**
     * @test
     */
    public function 隣接セルを設定できる() {
        $neighborCell = new Cell(new Position(2,1));

        $this->sut->setNeighbor(Direction::R(), $neighborCell);

        $this->assertEquals($neighborCell, $this->sut->neighbor(Direction::R()));
        $this->assertEquals($this->sut, $neighborCell->neighbor(Direction::R()->opposite()));
    }

    /**
     * @test
     */
    public function すでにある隣接セルを上書きできる() {
        $neighborCell1 = new Cell(new Position(2,1));
        $this->sut->setNeighbor(Direction::R(), $neighborCell1);

        $neighborCell2 = new Cell(new Position(2,1));
        $this->sut->setNeighbor(Direction::R(), $neighborCell2);


        $this->assertSame($neighborCell2, $this->sut->neighbor(Direction::R()));
    }

    /**
     * @test
     */
    public function 不正な位置を隣接セルとして設定できない() {
        $neighborCell = new Cell(new Position(2,1));

        $this->expectException(\InvalidArgumentException::class);
        $this->sut->setNeighbor(Direction::L(), $neighborCell);
    }

}

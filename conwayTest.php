<?php

/**
 * Created by PhpStorm.
 * User: ialbescu
 * Date: 11/14/15
 * Time: 11:29 AM
 */
include 'conway.php';

class conwayTest extends PHPUnit_Framework_TestCase
{
    protected $conway;

    protected function setUp()
    {
        $this->conway = new conway();
    }

    public function testInitializationWithoutLivingCells()
    {
        $this->assertEmpty($this->conway->getLivingCells());
    }

    public function testObjectWithOneLivingCell()
    {
        $expected = [
            0 => [
                2 => 1
            ]
        ];

        $this->conway->addLivingCell(0,2);
        $this->assertSame($expected, $this->conway->getCells());
    }

    public function testObjectWithMultipleLivingCell()
    {
        $expected = [
            0 => [
                2 => 1
            ],
            1 => [
                1 => 1,
                2 => 1,
                3 => 1
            ]
        ];

        $this->conway->addLivingCell(0,2);
        $this->conway->addLivingCell(1,1);
        $this->conway->addLivingCell(1,2);
        $this->conway->addLivingCell(1,3);
        $this->assertSame($expected, $this->conway->getCells());
    }

    public function testLivingCellValues()
    {
        $expected = 1;
        $this->conway->addLivingCell(0,2);
        $this->assertEquals($expected, $this->conway->getCellState(0, 2));
    }

    public function testCellsValues()
    {
        $this->conway->addLivingCell(0,2);
        $this->assertEquals(1, $this->conway->getCellState(0, 2));

        $this->assertEquals(0, $this->conway->getCellState(0, 0));
    }

    public function testCellNeighbours()
    {
        $this->conway->addLivingCell(0,2);
        $this->conway->addLivingCell(1,1);
        $this->conway->addLivingCell(1,2);
        $this->conway->addLivingCell(1,3);

        $this->assertEquals(3, $this->conway->getCellNeighbours(0,3));
    }

    public function testInterate()
    {
        $this->conway->addLivingCell(0,2);
        $this->conway->addLivingCell(1,1);
        $this->conway->addLivingCell(1,2);
        $this->conway->addLivingCell(1,3);

        $this->conway->iterateLivingCells();

        $expected = [
            0 => [
                1 => 1,
                2 => 1,
                3 => 1,
            ],
            1 => [
                1 => 1,
                2 => 1,
                3 => 1,
            ],
            2 => [
                2 => 1
            ]
        ];

        $this->assertSame($expected, $this->conway->getCells());

    }
}
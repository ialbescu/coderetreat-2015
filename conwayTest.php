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
    public function testInitialilzationWithoutAnyLiveCells()
    {
        $expected = [
            [0,0,0,0],
            [0,0,0,0],
            [0,0,0,0],
            [0,0,0,0]
        ];

        $conway = new conway(4,4);
        $resultGrid = $conway->getGrid();

        $this->assertSame($expected, $resultGrid);
    }

    public function testGridHasLiveCells()
    {
        $expected = [
            [0,0,1,0],
            [0,1,1,1],
            [0,0,0,0],
            [0,0,0,0]
        ];

        $conway = new conway(4,4);
        $conway->addLiveCell(0,2);
        $conway->addLiveCell(1,1);
        $conway->addLiveCell(1,2);
        $conway->addLiveCell(1,3);
        $resultGrid = $conway->getGrid();
        $this->assertSame($expected, $resultGrid);
    }

    public function testCellValue()
    {
        $conway = new conway(4,4);
        $conway->addLiveCell(0,2);
        $result = $conway->getCellStatus(0,2);
        $this->assertEquals(1, $result);
    }

    public function testCellValueForCoordonatesOutsideTheRange()
    {
        $conway = new conway(4,4);
        $conway->addLiveCell(0,2);
        $result = $conway->getCellStatus(-2,2);
        $this->assertEquals(0, $result);
    }

    public function testNumbersOfNeighbours()
    {
        $expected = 3;

        $conway = new conway(4,4);
        $conway->addLiveCell(0,2);
        $conway->addLiveCell(1,1);
        $conway->addLiveCell(1,2);
        $conway->addLiveCell(1,3);

        $numOfNeighbours = $conway->getNumOfNeighbours(0,3);

        $this->assertSame($expected, $numOfNeighbours);
    }
}
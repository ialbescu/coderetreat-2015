<?php

class conway
{
	private $rows;
	private $cols;
	private $grid = [];

	public function __construct($rows, $cols)
	{
		$this->rows = $rows;
		$this->cols = $cols;

		$this->grid = $this->initializeGrid();
	}

	private function initializeGrid()
	{
		$grid = [];

		for($i = 0; $i < $this->rows; $i++)
		{
			for($j = 0; $j < $this->cols; $j++)
			{
				$grid[$i][$j] = 0;
			}
		}

		return $grid;
	}

	public function getGrid()
	{
		return $this->grid;
	}

	public function showGrid($grid = null)
	{
		if(is_null($grid))
		{
			$grid = $this->grid;
		}

		$showGrid = '';

		for($i = 0; $i < $this->rows; $i++)
		{
			$showRow = '';

			for($j = 0; $j < $this->cols; $j++)
			{
				$showRow .= $grid[$i][$j];
			}

			$showGrid .= $showRow . "\n";
		}

		return $showGrid;
	}

	public function addLiveCell($row, $col)
	{
		$this->grid[$row][$col] = 1;
	}

	private function getCellValue($row, $col)
	{
		if($row < 0 || $row >= $this->rows || $col < 0 || $col >= $this->cols)
		{
			return 0;
		}

		return $this->grid[$row][$col];
	}

	public function getAround($row, $col)
	{
		$aroundNum = 0;

		// previous row
		$aroundNum += $this->getCellValue($row -1, $col -1);
		$aroundNum += $this->getCellValue($row -1, $col);
		$aroundNum += $this->getCellValue($row -1, $col + 1);

		// curent row
		$aroundNum += $this->getCellValue($row, $col - 1);
		$aroundNum += $this->getCellValue($row, $col + 1);

		// next row
		$aroundNum += $this->getCellValue($row + 1, $col -1);
		$aroundNum += $this->getCellValue($row + 1, $col);
		$aroundNum += $this->getCellValue($row + 1, $col + 1);

		return $aroundNum;
	}

	public function iterateGrid($oldGrid = null)
	{
		if(!is_null($oldGrid))
		{
			 $this->grid = $oldGrid;
		}

		$newGrid = $this->initializeGrid();

		for($i = 0; $i < $this->rows; $i++)
		{
			for($j =0; $j < $this->cols; $j++)
			{
				$val = $this->grid[$i][$j];

				$cellNumNeigh = $this->getAround($i, $j);

				if($cellNumNeigh === 3)
				{
					$newGrid[$i][$j] = 1;
				}

				if($cellNumNeigh === 2 && $val === 1)
				{
					$newGrid[$i][$j] = 1;
				}
			}
		}

		return $newGrid;
	}
}

$conway = new conway(4,4);
//echo $conway->showGrid();
//echo "\r\n";
$conway->addLiveCell(0,2);
$conway->addLiveCell(1,1);
$conway->addLiveCell(1,2);
$conway->addLiveCell(1,3);
echo $conway->showGrid();
echo "\r\n";
//echo $conway->getAround(2,1) . "\r\n";
//echo $conway->getAround(2,1) . "\r\n";

$newGrid = $conway->iterateGrid();
echo $conway->showGrid($newGrid);
echo "\r\n";

$existingGrid = $conway->getGrid();

for ($i =0; $i <10; $i++)
{
	$existingGrid = $conway->iterateGrid($existingGrid);
	echo $conway->showGrid($existingGrid) . "\r\n";
	sleep(2);
}

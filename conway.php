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

	private function getRand()
	{
		$rand = (float)rand()/(float)getrandmax();
		if ($rand < 0.4)
			return 0;
		else
			return 1;
	}

	private function initializeGrid($random = true)
	{
		//$colGrid = array_fill(0,$this->cols, ($random === true?$this->getRand():0));
		//$grid = array_fill(0,$this->rows, $colGrid);

		$grid = [];

		for($i = 0; $i < $this->rows; $i++)
		{
			for($j = 0; $j < $this->cols; $j++)
			{
				$grid[$i][$j] = $random === true?rand(0,1):0;
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

		foreach($grid as $rows)
		{
			$showGrid .= implode('', $rows);
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

		$newGrid = $this->initializeGrid(false);

        foreach($this->grid as $i => $rows)
        {
            foreach($rows as $j => $val)
            {
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

    public function getNumOfLiveCells($grid = null)
    {
		if(is_null($grid))
		{
			$grid = $this->grid;
		}

        $numOfLiveCels = 0;

		foreach($grid as $i => $rows)
		{
			$numOfLiveCels += array_sum($rows);
		}

        return $numOfLiveCels;
    }
}

$startPerfectGrid = [];
$perfectGrid = [];
$maxLiveCels = 0;

for($k = 0; $k < 2; $k++)
{
    $conway = new conway(100, 100);
    $startGrid = $conway->getGrid();

    //echo $k . "\r";
    for ($i = 0; $i < 1000; $i++)
	{
		if($i === 0)
		{
			$existingGrid = $startGrid;
		}
        echo $k . '.' . $i . "\r";

        $existingGrid = $conway->iterateGrid($existingGrid);
        $numOfLiveCells = $conway->getNumOfLiveCells($existingGrid);
        //echo $conway->showGrid($existingGrid) . "\r\n";
        //sleep(2);

        if($numOfLiveCells > $maxLiveCels)
        {
			$maxLiveCels = $numOfLiveCells;
            $perfectGrid = $existingGrid;
			$startPerfectGrid = $startGrid;
        }
    }
}

file_put_contents(dirname(__FILE__) . '/results/r-' . time() . '.txt', $maxLiveCels . "\r\n" . print_r($perfectGrid, true) . "\r\n" . print_r($startPerfectGrid, true));
echo 'result maxLive: ' . $maxLiveCels . "\r\n";
echo 'Initial: ' . "\n";
echo $conway->showGrid($startPerfectGrid) . "\r\n";
echo 'Result: ' . "\n";
echo $conway->showGrid($perfectGrid) . "\r\n";
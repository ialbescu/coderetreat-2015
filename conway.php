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

		$this->initilizeGrid();
	}

	private function initilizeGrid()
	{
		for($i = 0; $i < $this->rows; $i++)
		{
			for($j = 0; $j < $this->cols; $j++)
			{
				$this->grid[$i][$j] = 0;
			}
		}
	}

	public function addLiveCell($row, $cell)
	{
		$this->grid[$row][$cell] = 1;
	}

	public function getGrid()
	{
		return $this->grid;
	}

	public function getCellStatus ($row, $cols)
	{
		if($row < 0 || $row >= $this->rows || $cols < 0 || $cols >= $this->cols)
		{
			return 0;
		}

		return $this->grid[$row][$cols];
	}

	public function getNumOfNeighbours($row, $cols)
	{
		$numOfNeigh = 0;

		// get values for previous line
		$numOfNeigh += $this->getCellStatus($row -1, $cols - 1);
		$numOfNeigh += $this->getCellStatus($row -1, $cols);
		$numOfNeigh += $this->getCellStatus($row -1, $cols + 1);

		// get value for current line
		$numOfNeigh += $this->getCellStatus($row, $cols - 1);
		$numOfNeigh += $this->getCellStatus($row, $cols + 1);

		// get value for next line
		$numOfNeigh += $this->getCellStatus($row, $cols - 1);
		$numOfNeigh += $this->getCellStatus($row, $cols + 1);
	}
}
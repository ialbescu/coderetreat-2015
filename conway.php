<?php

class conway
{
	private $cells = [];

	public function getLivingCells()
	{
		return [];
	}

	public function addLivingCell($row, $col)
	{
		$this->cells[$row][$col] = 1;
	}

	public function getCells()
	{
		return $this->cells;
	}

	public function getCellState($row, $col)
	{
		if(!isset($this->cells[$row]) || !isset($this->cells[$row][$col]))
		{
			return 0;
		}

		return $this->cells[$row][$col];
	}

	public function getCellNeighbours($row, $col)
	{
		$numNeigh = 0;

		// get previous line
		$numNeigh += $this->getCellState($row - 1, $col - 1);
		$numNeigh += $this->getCellState($row - 1, $col);
		$numNeigh += $this->getCellState($row - 1, $col + 1);

		// get current line
		$numNeigh += $this->getCellState($row, $col - 1);
		$numNeigh += $this->getCellState($row, $col + 1);

		// get next line
		$numNeigh += $this->getCellState($row + 1, $col - 1);
		$numNeigh += $this->getCellState($row + 1, $col);
		$numNeigh += $this->getCellState($row + 1, $col + 1);

		return $numNeigh;
	}

	public function iterateLivingCells()
	{
		$newCells = [];

		for($i = 0; $i < count($this->cells); $i++)
		{
			for($j = 0; $j < count($this->cells[$i]); $j++)
			{
				// george.m.banica@gmail.com
			}
		}
	}
}
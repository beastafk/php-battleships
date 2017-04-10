<?php

namespace Battleships\Model;

class Board {

	const NUMBER_TO_LETTERS_MAP = [
		1 => "A",
		2 => "B",
		3 => "C",
		4 => "D",
		5 => "E",
		6 => "F",
		7 => "G",
		8 => "H",
		9 => "I",
		10 => "J",
	];
	private $boardHeight;
	private $boardWidth;
	private $grid;

	public function __construct(int $boardHeight, int $boardWidth) {
		$this->boardHeight = $boardHeight;
		$this->boardWidth = $boardWidth;
		$this->init();
	}

	/**
	 * @return int
	 */
	public function getBoardHeight()
	{
		return $this->boardHeight;
	}

	/**
	 * @param int $boardHeight
	 */
	public function setBoardHeight($boardHeight)
	{
		$this->boardHeight = $boardHeight;
	}

	/**
	 * @return int
	 */
	public function getBoardWidth()
	{
		return $this->boardWidth;
	}

	/**
	 * @param int $boardWidth
	 */
	public function setBoardWidth($boardWidth)
	{
		$this->boardWidth = $boardWidth;
	}


	public function init () {
		$this->grid = [];
		for ($i = 1; $i <= $this->getBoardHeight(); $i++) {
			$this->grid[$i] = [];
		}

		foreach ($this->grid as $gridColumnNumber => $gridColumn) {
			for ($i = 1; $i <= $this->getBoardWidth(); $i++) {
				$this->grid[$gridColumnNumber][$i] = new BoardField(self::NUMBER_TO_LETTERS_MAP[$gridColumnNumber] . $i);
			}
		}

		return $this->grid;
	}

	public function getGrid() {
		return $this->grid;
	}

	/**
	 * @param $x
	 * @param $y
	 * @return BoardField
	 */
	public function getBoardFieldByCoordinates(int $x, int $y) {
		return isset($this->grid[$x][$y]) ? $this->grid[$x][$y] : null;
	}

}
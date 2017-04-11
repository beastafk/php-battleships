<?php

namespace Battleships\Model;

class Board {

	// will be used with the chr function, we start from 64, because of the non-zero starting arrays. ex. 65 === 'A'
	const CHR_START_NUMBER = 64;

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
	public function getBoardHeight(): int {
		return $this->boardHeight;
	}

	/**
	 * @param int $boardHeight
	 */
	public function setBoardHeight($boardHeight) {
		$this->boardHeight = $boardHeight;
	}

	/**
	 * @return int
	 */
	public function getBoardWidth(): int {
		return $this->boardWidth;
	}

	/**
	 * @param int $boardWidth
	 */
	public function setBoardWidth($boardWidth) {
		$this->boardWidth = $boardWidth;
	}


	/**
	 * Initializes an empty grid
	 *
	 * @return array
	 */
	public function init(): array {
		$this->grid = [];
		for ($i = 1; $i <= $this->getBoardHeight(); $i++) {
			$this->grid[$i] = [];
		}

		foreach ($this->grid as $gridColumnNumber => $gridColumn) {
			for ($i = 1; $i <= $this->getBoardWidth(); $i++) {
				$this->grid[$gridColumnNumber][$i] = new BoardField($this->getBoardLetterByColumnNumber($gridColumnNumber) . $i);
			}
		}

		return $this->grid;
	}

	/**
	 * @return array
	 */
	public function getGrid(): array {
		return $this->grid;
	}

	/**
	 * @param $x
	 * @param $y
	 * @return BoardField|null
	 */
	public function getBoardFieldByCoordinates(int $x, int $y) {
		return isset($this->grid[$x][$y]) ? $this->grid[$x][$y] : null;
	}

	/**
	 * @param string $fieldName
	 * @return BoardField|null
	 */
	public function getBoardFieldByName(string $fieldName) {
		foreach ($this->grid as $columnNumber => $rows) {
			foreach ($rows as $boardField) {
				if ($fieldName === $boardField->getName()) {
					return $boardField;
				}
			}
		}

		return null;
	}

	/**
	 * @param int $gridColumnNumber
	 * @return string
	 */
	public function getBoardLetterByColumnNumber($gridColumnNumber) {
		return chr(self::CHR_START_NUMBER + $gridColumnNumber);
	}

}
<?php

namespace Battleships\Helper\ShipPlacement;

use Battleships\Model\Board;
use Battleships\Model\Ship;
use Battleships\Exception\CannotPlaceShipException;

class RandomShipPlacement implements ShipPlacementInterface {
	/**
	 *
	 * @var Ship[]
	 */
	private $ships = [];
	private $numberOfRetries;

	public function __construct(array $ships, int $numberOfRetries) {
		$this->ships = $ships;
		$this->numberOfRetries = $numberOfRetries;
	}

	public function placeShipsOnBoard(Board $board) {
		foreach ($this->ships as $ship) {
			$placed = false;

			for ($retryNumber = 0; $retryNumber < $this->numberOfRetries; ++$retryNumber) {
				$direction = rand(1, 2) === 1 ? ShipPlacementInterface::DIRECTION_VERTICAL : ShipPlacementInterface::DIRECTION_HORIZONTAL;

				if ($direction === ShipPlacementInterface::DIRECTION_VERTICAL) {
					if ($this->placeVerticalShipOnBoard($board, $ship)) {
						$placed = true;
						break;
					}
				} else if ($direction === ShipPlacementInterface::DIRECTION_HORIZONTAL) {
					if ($this->placeHorizontalShipOnBoard($board, $ship)) {
						$placed = true;
						break;
					}
				}
			}

			if (!$placed) {
				throw new CannotPlaceShipException(sprintf("Failed placing ship after %d retries", $this->numberOfRetries));
			}
		}
	}

	public function placeVerticalShipOnBoard(Board $board, Ship $ship) {
		$columnNumber = rand(1, $board->getBoardHeight());
		$rowNumber = rand(1, $board->getBoardWidth());
		// check if the grid is out of bound
		if ($columnNumber + $ship->getShipSize() > $board->getBoardHeight() + 1) {
			return false;
		}

		// check for other ships
		for ($i = $columnNumber; isset($board->getGrid()[$i]); $i++) {
			$boardField = $board->getBoardFieldByCoordinates($i, $rowNumber);
			if ($boardField->hasShip()) {
				return false;
			}
		}

		for ($i = $columnNumber; $i < $columnNumber + $ship->getShipSize(); $i++) {
			$board->getBoardFieldByCoordinates($i, $rowNumber)->setShip($ship);
		}

		return true;
	}

	public function placeHorizontalShipOnBoard(Board $board, Ship $ship) {
		$columnNumber = rand(1, $board->getBoardHeight());
		$rowNumber = rand(1, $board->getBoardWidth());

		// check if the grid is out of bound
		if ($rowNumber + $ship->getShipSize() > $board->getBoardWidth() + 1) {
			return false;
		}

		// check for other ships
		for ($i = $rowNumber; isset($board->getGrid()[$columnNumber][$i]); $i++) {
			$boardField = $board->getBoardFieldByCoordinates($columnNumber, $i);
			if ($boardField->hasShip()) {
				return false;
			}
		}

		for ($i = $rowNumber; $i < $rowNumber + $ship->getShipSize(); $i++) {
			$board->getBoardFieldByCoordinates($columnNumber, $i)->setShip($ship);
		}

		return true;
	}

}
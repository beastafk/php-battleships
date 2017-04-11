<?php

namespace Battleships\Helper;

use Battleships\Helper\ShipPlacement\ShipPlacementInterface;
use Battleships\Model\Board;
use Battleships\Model\State;
use Battleships\Exception\CannotPlaceShipException;

class StateCreator {

	private $verticalSize;
	private $horizontalSize;
	private $shipPlacementService;

	/**
	 * @param int $verticalSize
	 * @param int $horizontalSize
	 * @param ShipPlacementInterface $shipPlacementService
	 */
	public function __construct(int $verticalSize, int $horizontalSize, ShipPlacementInterface $shipPlacementService) {
		$this->verticalSize = $verticalSize;
		$this->horizontalSize = $horizontalSize;
		$this->shipPlacementService = $shipPlacementService;
	}

	/**
	 * @return State
	 * @throws CannotPlaceShipException
	 */
	public function createEmptyState() {
		$board = new Board($this->verticalSize, $this->horizontalSize);
		try {
			$this->shipPlacementService->placeShipsOnBoard($board);
		} catch (CannotPlaceShipException $e) {
			throw $e;
		}

		return new State($board, 0);
	}

}
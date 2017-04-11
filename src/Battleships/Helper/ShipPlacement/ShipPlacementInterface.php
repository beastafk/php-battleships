<?php

namespace Battleships\Helper\ShipPlacement;

use Battleships\Exception\CannotPlaceShipException;
use Battleships\Model\Board;
use Battleships\Model\Ship;

interface ShipPlacementInterface {

	const DIRECTION_VERTICAL = 'vertical';
	const DIRECTION_HORIZONTAL = 'horizontal';

	/**
	 * @param Board $board
	 * @throws CannotPlaceShipException
	 * @return mixed
	 */
	public function placeShipsOnBoard(Board $board);
}
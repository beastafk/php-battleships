<?php

namespace Battleships\Helper\ShipPlacement;

use Battleships\Model\Board;
use Battleships\Model\Ship;

interface ShipPlacementInterface {

	const DIRECTION_VERTICAL = 'vertical';
	const DIRECTION_HORIZONTAL = 'horizontal';

	public function placeShipsOnBoard(Board $board);
}
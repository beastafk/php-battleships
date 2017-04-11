<?php

use Battleships\Exception\CannotPlaceShipException;
use Battleships\Helper\ShipPlacement\RandomShipPlacement;
use Battleships\Model\Board;
use Battleships\Model\Ship;
use PHPUnit\Framework\TestCase;


class RandomShipPlacementTest extends TestCase {

	private $ships;

	public function setUp() {
		$this->ships = [];
		$shipsData = [
			["Battleship", 5],
			["Destroyer", 4],
			["Destroyer", 4],
		];

		foreach ($shipsData as $shipProperties) {
			$this->ships[] = new Ship($shipProperties[0], $shipProperties[1]);
		}
	}

	private function getTestShips() {
		return $this->ships;
	}

	public function testRandomShipPlacementWillPlaceTestShipsWithin100Retries() {
		$board = new Board(10, 10);
		$randomShipPlacement = new RandomShipPlacement($this->getTestShips(), 100);

		$this->assertEquals(true, $randomShipPlacement->placeShipsOnBoard($board));
	}

	public function testShipsWillNotBePlacedOnSmallerBoard() {
		$board = new Board(3, 3);
		$randomShipPlacement = new RandomShipPlacement($this->getTestShips(), 100);

		$this->expectException(CannotPlaceShipException::class);

		$randomShipPlacement->placeShipsOnBoard($board);
	}

	public function testLongerShipWillNotBePlacedOnBoard() {
		$ship = new Ship("Long ship", 12);
		$board = new Board(10, 10);

		$randomShipPlacement = new RandomShipPlacement([$ship], 100);

		$this->expectException(CannotPlaceShipException::class);
		$randomShipPlacement->placeShipsOnBoard($board);
	}

}
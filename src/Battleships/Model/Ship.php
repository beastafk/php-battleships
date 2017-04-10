<?php

namespace Battleships\Model;


class Ship {

	private $name;
	private $shipSize;
	private $hasSunk;
	private $isPlaced;

	/**
	 * Ship constructor.
	 * @param string $name
	 * @param int $shipSize
	 * @param bool $isHit
	 * @param bool $isPlaced
	 */
	public function __construct(string $name, int $shipSize, bool $hasSunk = false, bool $isPlaced = false)
	{
		$this->name = $name;
		$this->shipSize = $shipSize;
		$this->hasSunk = $hasSunk;
		$this->isPlaced = $isPlaced;
	}

	/**
	 * @param string $name
	 */
	public function setName(string $name) {
		$this->name = $name;
	}

	public function getName() :string {
		return $this->name;
	}

	/**
	 * @param int $shipSize
	 */
	public function setShipSize(int $shipSize) {
		$this->shipSize = $shipSize;
	}

	public function getShipSize() :int {
		return $this->shipSize;
	}

	/**
	 * @return mixed
	 */
	public function getHasSunk()
	{
		return $this->hasSunk;
	}

	/**
	 * @param mixed $hasSunk
	 */
	public function setHasSunk($hasSunk)
	{
		$this->hasSunk = $hasSunk;
	}

	public function setIsPlaced(bool $isPlaced) {
		$this->isPlaced = $isPlaced;
	}


	public function getIsPlaced() {
		return $this->isPlaced;
	}
}
<?php

namespace Battleships\Model;

class BoardField {


	private $fieldName;
	private $hasShip = false;
	private $ship = null;
	private $isHit = false;

	public function __construct(string $fieldName, bool $hasShip = false)
	{
		$this->fieldName = $fieldName;
		$this->hasShip = $hasShip;
	}

	public function setName($fieldName) {
		$this->fieldName = $fieldName;
	}

	public function getName() {
		return $this->fieldName;
	}

	/**
	 * @return Ship|null
	 */
	public function getShip()
	{
		return $this->ship;
	}

	/**
	 * @param Ship $ship
	 */
	public function setShip(Ship $ship)
	{
		$this->ship = $ship;
	}

	public function hasShip() {
		return $this->getShip() !== null;
	}

	/**
	 * @return bool
	 */
	public function getIsHit(): bool
	{
		return $this->isHit;
	}

	/**
	 * @param bool $isHit
	 */
	public function setIsHit(bool $isHit)
	{
		$this->isHit = $isHit;
	}

}
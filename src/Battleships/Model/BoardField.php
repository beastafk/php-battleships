<?php

namespace Battleships\Model;

class BoardField {

	private $fieldName;
	private $ship = null;
	private $isHit = false;

	public function __construct(string $fieldName) {
		$this->fieldName = $fieldName;
	}

	public function getName(): string{
		return $this->fieldName;
	}

	/**
	 * @return Ship|null
	 */
	public function getShip() {
		return $this->ship;
	}

	/**
	 * @param Ship $ship
	 */
	public function setShip(Ship $ship) {
		$this->ship = $ship;
	}

	/**
	 * @return bool
	 */
	public function hasShip() {
		return $this->getShip() !== null;
	}

	/**
	 * @param bool $isHit
	 */
	public function setIsHit(bool $isHit) {
		$this->isHit = $isHit;
	}

	/**
	 * @return bool
	 */
	public function isHit(): bool {
		return $this->isHit === true;
	}

}
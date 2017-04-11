<?php

namespace Battleships\Model;

class Ship {

	private $name;
	private $size;
	/**
	 * Ship constructor.
	 * @param string $name
	 * @param int $size
	 */
	public function __construct(string $name, int $size)
	{
		$this->name = $name;
		$this->size = $size;
	}

	/**
	 * @return string
	 */
	public function getName(): string {
		return $this->name;
	}

	/**
	 * @return int
	 */
	public function getSize(): int {
		return $this->size;
	}
}
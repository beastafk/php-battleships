<?php

namespace Battleships\StateStorage;

use Battleships\Model\State;

class ArrayStateStorage implements StateStorageInterface {

	private $gameName;
	private $state = array();

	/**
	 * @param string $gameName
	 */
	public function __construct(string $gameName)
	{
		$this->gameName = $gameName;
	}

	/**
	 * @return State|null
	 */
	public function getState()
	{
		if (isset($this->state[$this->gameName])) {
			$state = $this->state[$this->gameName];
			if ($state instanceof State) {
				return $state;
			}
		}

		return null;
	}

	/**
	 * @param State $currentState
	 */
	public function saveState(State $currentState)
	{
		$this->state[$this->gameName] = $currentState;
	}
}
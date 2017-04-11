<?php

namespace Battleships\StateStorage;

use Battleships\Model\State;

class SessionStateStorage implements StateStorageInterface {

	private $gameName;

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
		if (isset($_SESSION[$this->gameName])) {
			$state = unserialize($_SESSION[$this->gameName]);
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
		$state = serialize($currentState);
		$_SESSION[$this->gameName] = $state;
	}
}
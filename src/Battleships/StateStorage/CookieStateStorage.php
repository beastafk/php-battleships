<?php

namespace Battleships\StateStorage;

use Battleships\Model\State;

class CookieStateStorage implements StateStorageInterface {

	private $gameName;

	public function __construct(string $gameName)
	{
		$this->gameName = $gameName;
	}

	/**
	 * @return State|null
	 */
	public function getState()
	{
		if (isset($_COOKIE[$this->gameName])) {
			$state = unserialize($_COOKIE[$this->gameName]);
			if ($state instanceof State) {
				return $state;
			}
		}

		return null;
	}

	/**
	 * @param $currentState
	 */
	public function saveState(State $currentState)
	{
		$state = serialize($currentState);
		setcookie($this->gameName, $state, time() + (86400 * 7));
	}
}
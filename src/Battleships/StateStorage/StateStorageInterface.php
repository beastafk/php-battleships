<?php

namespace Battleships\StateStorage;

use Battleships\Model\State;

interface StateStorageInterface {

	public function saveState(State $currentState);


	/**
	 * @return State|null
	 */
	public function getState();
}
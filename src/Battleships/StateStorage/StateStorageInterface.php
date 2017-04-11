<?php

namespace Battleships\StateStorage;

use Battleships\Model\State;

interface StateStorageInterface {

	/**
	 * @param State $currentState
	 * @return mixed
	 */
	public function saveState(State $currentState);


	/**
	 * @return State|null
	 */
	public function getState();
}
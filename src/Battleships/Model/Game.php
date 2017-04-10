<?php

namespace Battleships\Model;


use Battleships\Model\State;

class Game {

	private $state;

	public function __construct(State $state) {
		$this->state = $state;
	}


	public function handleInput(State $state, string $input) {
		if ($this->validator->isValid($state, $input)) {
			$boardField = $state->getBoard()->getBoardFieldByName($input);
			$boardField->hit();
		}

		$this->checkIfGameIsOver();
	}
}
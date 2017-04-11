<?php

namespace Battleships\Helper;


use Battleships\Model\BoardField;
use Battleships\Model\Ship;
use Battleships\Model\State;
use Battleships\Validator\ValidatorInterface;

class GameProcessor {

	const HANDLE_RESULT_HIT = "*** Hit ***";
	const HANDLE_RESULT_MISS = "*** Miss ***";
	const HANDLE_RESULT_ERROR = "*** Error ***";
	const HANDLE_RESULT_SUNK = "*** Sunk ***";
	const HANDLE_GAME_OVER = "*** Game Over ***";

	private $inputValidator;

	public function __construct(ValidatorInterface $validator) {
		$this->inputValidator = $validator;
	}

	public function handleInput(State $state, string $input) {
		if (!$this->inputValidator->isValid($input)) {
			return self::HANDLE_RESULT_ERROR;
		}

		$boardField = $state->getBoard()->getBoardFieldByName($input);

		$state->setShotsTaken($state->getShotsTaken() + 1);

		if ($boardField->isHit()) {
			return self::HANDLE_RESULT_MISS;
		}

		$boardField->setIsHit(true);

		if (!$boardField->hasShip()) {
			return self::HANDLE_RESULT_MISS;
		}

		if ($this->checkIfGameIsOver($state)) {
			return self::HANDLE_GAME_OVER;
		}

		if ($this->checkIfShipHasSunk($state, $boardField->getShip())) {
			return self::HANDLE_RESULT_SUNK;
		}

		return self::HANDLE_RESULT_HIT;

	}

	/**
	 * @param State $state
	 * @return bool
	 */
	private function checkIfGameIsOver(State $state) {
		foreach($state->getBoard()->getGrid() as $column => $row) {
			foreach ($row as $boardField) {
				if ($boardField->hasShip() && !$boardField->isHit()) {
					return false;
				}
			}
		}

		return true;
	}

	/**
	 * @param State $state
	 * @param Ship $ship
	 * @return bool
	 */
	private function checkIfShipHasSunk(State $state, Ship $ship) {
		$shipHasSunk = true;

		foreach($state->getBoard()->getGrid() as $column => $row) {
			/* @var $row BoardField[] */
			foreach ($row as $boardField) {
				// we are looking for a BoardField which is not hit and has the Ship that we check against
				if ($boardField->hasShip() && $boardField->getShip() === $ship && !$boardField->isHit()) {
					$shipHasSunk = false;
				}
			}
		}

		return $shipHasSunk;
	}
}
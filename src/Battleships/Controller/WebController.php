<?php

namespace Battleships\Controller;

use Battleships\Model\Board;
use Battleships\Model\BoardField;
use Battleships\Model\Game;
use Battleships\Model\State;
use Battleships\StateStorage\CookieStateStorage;
use Battleships\StateStorage\StateStorageInterface;
use Battleships\Helper\StateCreator;
use Battleships\Exception\CannotPlaceShipException;
use Battleships\Renderer\RendererInterface;

class WebController {

	private $stateStorage;
	private $stateCreator;

	public function __construct(StateStorageInterface $stateStorage, StateCreator $stateCreator, RendererInterface $renderer)
	{
		$this->stateStorage = $stateStorage;
		$this->stateCreator = $stateCreator;
		$this->renderer = $renderer;
	}

	public function initGame() {
		$error = null;
		$input = $this->getInputFromRequest($_POST);
		$activateCheat = true;

		if ($input === 'show') {
			$input = null;
			$activateCheat = true;
		}

		$currentGameState = $this->stateStorage->getState();
		if ($currentGameState === null) {
			try {
				$currentGameState = $this->stateCreator->createEmptyState();
			} catch (CannotPlaceShipException $e) {
				$error = $e->getMessage();
			}
		}

		// @TODO create game factory
		$game = new Game();
		$game->processInput($currentGameState, $input);

		if ($error === null) {
			return $this->renderer->render($currentGameState->getBoard(), $activateCheat);
		}

		echo $error;
	}

	/**
	 *
	 * @param array $request
	 * @return NULL|string
	 */
	private function getInputFromRequest($request) {
		if (!isset($request['input'])) {
			return null;
		}

		return $request['input'];
	}
}
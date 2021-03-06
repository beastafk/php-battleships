<?php

namespace Battleships\Controller;

use Battleships\Helper\GameProcessor;
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
	private $gameProcessor;
	private $renderer;

	/**
	 * @param StateStorageInterface $stateStorage
	 * @param StateCreator $stateCreator
	 * @param RendererInterface $renderer
	 */
	public function __construct(StateStorageInterface $stateStorage, StateCreator $stateCreator, GameProcessor $gameProcessor, RendererInterface $renderer) {
		$this->stateStorage = $stateStorage;
		$this->stateCreator = $stateCreator;
		$this->gameProcessor = $gameProcessor;
		$this->renderer = $renderer;
	}

	public function run() {
		$activateCheat = false;
		$resetGame = false;
		$error = null;
		$result = '';
		$input = $this->getInputFromRequest($_POST);

		if ($input === 'show') {
			$input = null;
			$activateCheat = true;
		}

		if ($input === 'reset') {
			$input = null;
			$resetGame = true;
		}

		$currentGameState = $this->stateStorage->getState();

		if ($resetGame || $currentGameState === null) {
			try {
				$currentGameState = $this->stateCreator->createEmptyState();
			} catch (CannotPlaceShipException $e) {
				$error = $e->getMessage();
			}
		}

		if ($input) {
			$result = $this->gameProcessor->handleInput($currentGameState, $input);
		}

		if ($error !== null) {
			echo "ERROR: " . $error;
			return;
		}

		$this->renderer->render($result, $currentGameState, $activateCheat);


		if ($result === GameProcessor::HANDLE_GAME_OVER) {
			$currentGameState = $this->stateCreator->createEmptyState();
		}

		$this->stateStorage->saveState($currentGameState);
	}

	/**
	 *
	 * @param array $request
	 * @return NULL|string
	 */
	private function getInputFromRequest($request) {
		if (!isset($request['coord'])) {
			return null;
		}

		return trim($request['coord']);
	}
}
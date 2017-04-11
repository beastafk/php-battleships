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

class CliController {

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
		$error = null;
		$result = '';
		$stdin = fopen('php://stdin', 'r');
		$input = null;

		$currentGameState = $currentGameState = $this->stateCreator->createEmptyState();
		$this->renderer->render('', $currentGameState, $activateCheat);

		while (true) {
			$input = $this->getInputFromSTDIN($stdin);

			if ($input === 'show') {
				$input = null;
				$activateCheat = true;
			}

			if ($input === 'reset') {
				$input = null;
				$currentGameState = $currentGameState = $this->stateCreator->createEmptyState();
			}

			if ($input) {
				$result = $this->gameProcessor->handleInput($currentGameState, $input);
			}

			$this->renderer->render($result, $currentGameState, $activateCheat);
			$activateCheat = false;

			if ($result === GameProcessor::HANDLE_GAME_OVER) {
				exit;
			}
		}
	}

	/**
	 *
	 * @param mixed $stdin
	 * @return NULL|string
	 */
	private function getInputFromSTDIN($stdin) {

		return trim(fgets($stdin));
	}
}
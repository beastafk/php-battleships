<?php

namespace Battleships\Renderer;

use Battleships\Helper\GameProcessor;
use Battleships\Model\Board;
use Battleships\Model\BoardField;
use Battleships\Model\State;

class WebRenderer extends AbstractRenderer implements RendererInterface {

	/**
	 * @param string $result
	 * @param State $state
	 * @param bool $activateCheat
	 */
	public function render($result, State $state, bool $activateCheat) {
		if ($result === GameProcessor::HANDLE_GAME_OVER) {
			return $this->renderGameOver($state);
		}

		$board = $state->getBoard();

		echo "<pre>";

		echo $result !== '' ? $result : $this->newLine;

		echo str_repeat($this->newLine, 2);

		for ($colNumber = 1; $colNumber <= $board->getBoardWidth(); $colNumber++) {
			if ($colNumber === 1) {
				echo str_repeat($this->emptySpace, 2);
			}
			echo $colNumber . str_repeat($this->emptySpace, 2);
		}

		echo $this->newLine;

		foreach ($board->getGrid() as $gridColumn => $gridRow) {
			echo $board->getBoardLetterByColumnNumber($gridColumn);
			echo $this->emptySpace;

			foreach ($gridRow as $boardField) {
				$this->renderBoardField($boardField, $activateCheat);
			}

			echo $this->newLine;
		}

		echo $this->newLine;
		echo "</pre>";

		echo '
			<form name="input" action="index.php" method="post">
				Enter coordinates (row, col), e.g. A5 <input type="input" size="5" name="coord" autocomplete="off" autofocus="">
				<input type="submit">
			</form>
		';
	}

	/**
	 * @param State $state
	 */
	private function renderGameOver(State $state) {
		echo sprintf("<p>Well done! You completed the game in %d shots.</p>", $state->getShotsTaken());
		echo '<p><a href="index.php">Play again?</a></p>';
	}
}
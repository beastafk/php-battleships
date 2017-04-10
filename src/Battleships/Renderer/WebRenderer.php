<?php

namespace Battleships\Renderer;

use Battleships\Model\Board;
use Battleships\Model\BoardField;

class WebRenderer implements RendererInterface {

	private $emptySpace  = " ";
	private $newLine = PHP_EOL;
	private $fieldIsHitSymbol = "-";
	private $shipIsHitSymbol = "X";
	private $noHitSymbol = ".";

	public function render(Board $board, bool $activateCheat) {
		echo "<pre>";

		echo str_repeat($this->newLine, 2);

		for ($colNumber = 1; $colNumber <= $board->getBoardWidth(); $colNumber++) {
			if ($colNumber === 1) {
				echo str_repeat($this->emptySpace, 2);
			}
			echo $colNumber . str_repeat($this->emptySpace, 2);
		}

		echo $this->newLine;

		foreach ($board->getGrid() as $gridColumn => $gridRow) {
			echo Board::NUMBER_TO_LETTERS_MAP[$gridColumn];
			echo $this->emptySpace;

			foreach ($gridRow as $boardField) {
				$this->renderBoardField($boardField, $activateCheat);
			}

			echo $this->newLine;
		}

		echo "</pre>";
	}

	private function renderBoardField(BoardField $boardField, bool $activateCheat) {
		//@TOOD $boardField->getIsHit() for the first if
		if (($activateCheat || $boardField->getIsHit()) && $boardField->hasShip()) {
			echo $this->shipIsHitSymbol;
		} else if ($boardField->getIsHit()) {
			echo $this->fieldIsHitSymbol;
		} else {
			echo $activateCheat ? $this->emptySpace : $this->noHitSymbol;
		}

		echo str_repeat($this->emptySpace, 2);
	}
}
<?php

namespace Battleships\Renderer;


use Battleships\Model\BoardField;

abstract class AbstractRenderer {

	protected $emptySpace  = " ";
	protected $newLine = PHP_EOL;
	protected $fieldIsHitSymbol = "-";
	protected $shipIsHitSymbol = "X";
	protected $noHitSymbol = ".";

	/**
	 * @param BoardField $boardField
	 * @param bool $activateCheat
	 */
	protected function renderBoardField(BoardField $boardField, bool $activateCheat) {
		if (($activateCheat || $boardField->isHit()) && $boardField->hasShip()) {
			echo ($activateCheat && $boardField->isHit()) ? $this->emptySpace : $this->shipIsHitSymbol;
		} else if ($boardField->isHit()) {
			echo ($activateCheat && $boardField->isHit()) ? $this->emptySpace : $this->fieldIsHitSymbol;
		} else {
			echo $activateCheat ? $this->emptySpace : $this->noHitSymbol;
		}

		echo str_repeat($this->emptySpace, 2);
	}
}
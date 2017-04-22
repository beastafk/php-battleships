<?php

use Battleships\Helper\GameProcessor;
use Battleships\Model\Ship;
use Battleships\Model\Board;
use PHPUnit\Framework\TestCase;
use Battleships\Model\State;


class GameProcessorTest extends TestCase {

	public $board;
	public $grid;

	public function setUp() {
		$this->board = new Board(5, 5);
		$this->grid = $this->board->getGrid();

		$testShip = new Ship("test Ship", 1);

		foreach ($this->grid as $key => $boardFieldRow) {
			foreach ($boardFieldRow as $key => $boardField) {
				$boardField->setShip($testShip);
			}
		}
		$this->state = new State($this->board, 0);
	}

	public function testHandleInputHit() {
		$stateInputMock = $this->getMockBuilder('Battleships\Validator\StateInputValidator')->getMock();
		$stateInputMock->expects($this->once())->method('isValid')->willReturn(true);
		$gameProcessor = new GameProcessor($stateInputMock);

		$input = 'A1';
		$response = $gameProcessor->handleInput($this->state, $input);
		$this->assertEquals(GameProcessor::HANDLE_RESULT_HIT, $response);
	}

	public function testHandleInputMissAfterHit() {
		$stateInputMock = $this->getMockBuilder('Battleships\Validator\StateInputValidator')->getMock();
		$stateInputMock->expects($this->atLeastOnce())->method('isValid')->willReturn(true);
		$gameProcessor = new GameProcessor($stateInputMock);

		$input = 'A1';
		$response = $gameProcessor->handleInput($this->state, $input);
		$input = 'A1';
		$response = $gameProcessor->handleInput($this->state, $input);
		$this->assertEquals(GameProcessor::HANDLE_RESULT_MISS, $response);
	}

	public function testHandleInputGameOver() {
		$stateInputMock = $this->getMockBuilder('Battleships\Validator\StateInputValidator')->getMock();
		$stateInputMock->expects($this->atLeastOnce())->method('isValid')->willReturn(true);
		$gameProcessor = new GameProcessor($stateInputMock);

		foreach ($this->state->getBoard()->getGrid()  as $key => $boardFieldRow) {
			foreach ($boardFieldRow as $key => $boardField) {
				/** @var \Battleships\Model\BoardField $boardField */
				$boardField->setIsHit(true);
				if ($boardField->getName() === "A1") {
					$boardField->setIsHit(false);
				}
			}
		}

		$input = 'A1';
		$response = $gameProcessor->handleInput($this->state, $input);
		$this->assertEquals(GameProcessor::HANDLE_GAME_OVER, $response);
	}

}
<?php


namespace Battleships\Model;


class State {

	private $board;
	private $shotsTaken = 0;

	/**
	 * @return int
	 */
	public function getShotsTaken(): int
	{
		return $this->shotsTaken;
	}

	/**
	 * @param int $shotsTaken
	 */
	public function setShotsTaken(int $shotsTaken)
	{
		$this->shotsTaken = $shotsTaken;
	}

	/**
	 * @return Board
	 */
	public function getBoard()
	{
		return $this->board;
	}

	/**
	 * @param Board $board
	 */
	public function setBoard(Board $board)
	{
		$this->board = $board;
	}

	public function __construct($board, $shotsTaken) {
		$this->setBoard($board);
		$this->setShotsTaken($shotsTaken);
	}
}
<?php

namespace Battleships\Renderer;

use Battleships\Model\Board;
use Battleships\Model\State;

interface RendererInterface {

	/**
	 * @param string $result
	 * @param State $state
	 * @param bool $activateCheat
	 * @return mixed
	 */
	public function render($result, State $state, bool $activateCheat);
}
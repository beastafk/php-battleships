<?php

namespace Battleships\Renderer;

use Battleships\Model\Board;

interface RendererInterface {

	public function render(Board $board, bool $activateCheat);
}
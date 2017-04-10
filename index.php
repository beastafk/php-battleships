<?php

error_reporting(E_ALL);
ini_set("display_errors", "on");

require __DIR__ . '/vendor/autoload.php';

use Battleships\Controller\WebController;
use Battleships\Helper\ShipPlacement\RandomShipPlacement;
use Battleships\StateStorage\CookieStateStorage;
use Battleships\Helper\StateCreator;
use Battleships\Model\Ship;
use Battleships\Renderer\WebRenderer;

$isCLI = (php_sapi_name() === 'cli');

$config = [
	"verticalSize" => 10,
	'horizontalSize' => 10,
	"gameName" => "battleships",
	"ships" => array(
		array("Battleship", 5),
		array("Destroyer", 4),
		array("Destroyer", 4),
	),
	'numberOfPlacementRetries' => 100,
];

$ships = [];
foreach ($config['ships'] as $shipProperties) {
	$ships[] = new Ship($shipProperties[0], $shipProperties[1], false);
}

$config["shipPlacementService"] = new RandomShipPlacement($ships, $config['numberOfPlacementRetries']);
$config["stateCreator"] = new StateCreator($config['verticalSize'], $config['horizontalSize'], $config["shipPlacementService"]);
$config["stateStorage"] = new CookieStateStorage($config['gameName']);
$config["renderer"] = new WebRenderer();

if ($isCLI) {
	$controller = new WebController();
} else {
	$controller = new WebController($config["stateStorage"], $config["stateCreator"], $config['renderer']);
}

$controller->initGame();

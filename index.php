<?php

error_reporting(E_ALL);
ini_set("display_errors", "on");

session_start();

require __DIR__ . '/vendor/autoload.php';

use Battleships\Controller\CliController;
use Battleships\Controller\WebController;
use Battleships\Helper\GameProcessor;
use Battleships\Helper\ShipPlacement\RandomShipPlacement;
use Battleships\Renderer\CliRenderer;
use Battleships\StateStorage\CookieStateStorage;
use Battleships\Helper\StateCreator;
use Battleships\Model\Ship;
use Battleships\Renderer\WebRenderer;
use Battleships\StateStorage\SessionStateStorage;
use Battleships\Validator\StateInputValidator;

$config = [
	"verticalSize" => 10,
	"horizontalSize" => 10,
	"gameName" => "battleships",
	"ships" => [
		["Battleship", 5],
		["Destroyer", 4],
		["Destroyer", 4],
	],
	"numberOfPlacementRetries" => 100,
];

$ships = [];
foreach ($config['ships'] as $shipProperties) {
	$ships[] = new Ship($shipProperties[0], $shipProperties[1]);
}

$config["shipPlacementService"] = new RandomShipPlacement($ships, $config['numberOfPlacementRetries']);
$config["stateCreator"] = new StateCreator($config['verticalSize'], $config['horizontalSize'], $config["shipPlacementService"]);
$config["stateStorage"] = new SessionStateStorage($config['gameName']);
$config["validator"] = new StateInputValidator();
$config["gameProcessor"] = new GameProcessor($config["validator"]);
$config["webRenderer"] = new WebRenderer();
$config["cliRenderer"] = new CliRenderer();

if (php_sapi_name() === 'cli') {
	$controller = new CliController($config["stateStorage"], $config["stateCreator"], $config["gameProcessor"], $config["cliRenderer"]);
} else {
	$controller = new WebController($config["stateStorage"], $config["stateCreator"], $config["gameProcessor"], $config['webRenderer']);
}

$controller->run();

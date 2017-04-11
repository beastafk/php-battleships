# Battleships Test Task

The game starting point is **index.php** and it can be run both in the browser and from the terminal. The game is meant to be played in single player. 

# Requirements
  - PHP >=7.0

# Installation
 - `composer install`

# Configuration

The config is a simple array that mimics a container. What can be configured at the moment is:
 - Columns number -  `$config['verticalSize']`
 - Rows number -  `$config['horizontalSize']`
 - Number and type of ships - `$config['ships'] = [["Battleship", 5],["Destroyer", 4],["Destroyer", 4],]`
 - Number of retries in which the ships can be placed on the board - `$config['numberOfPlacementRetries']`

# Comands
 - `show` - will act as a cheat and show you the location of the ships on the board
 - `reset` - will give you a new board with random placement of the given ships
 
# Testing
 - There is [PHPStan](https://github.com/phpstan/phpstan) which make a static analysis of the code `vendor/bin/phpstan analyse -c phpstan.neon -l 5 src/`
 - PHPUnit tests are also included and they can be run with `vendor/bin/phpunit tests/`
 
# TO DO

 - Write more meaningful tests
<?php

require __DIR__ . '/vendor/autoload.php';

use Pebblip\Board;

$boardSize = $argv[1];

$board = Board::make($boardSize);

$board->put(new \Pebblip\Position(1, 1), \Pebblip\Stone::WHITE());
$board->put(new \Pebblip\Position(1, 2), \Pebblip\Stone::BLACK());
$board->put(new \Pebblip\Position(2, 1), \Pebblip\Stone::WHITE());
$board->put(new \Pebblip\Position(2, 2), \Pebblip\Stone::BLACK());
$board->put(new \Pebblip\Position(2, 3), \Pebblip\Stone::WHITE());

echo $board->toString(), PHP_EOL;

<?php

require __DIR__ . '/vendor/autoload.php';

use Pebblip\Board;
use Pebblip\Position;
use Pebblip\Stone;

$boardSize = $argv[1];

$board = Board::make($boardSize);

$currentStone = Stone::BLACK();
/**
 * @param $input
 *
 * @return Position
 */
function nextPosition($input): ?Position
{
    try {
        $positions = explode(',', trim($input));
        if (!is_numeric($positions[0]) || !is_numeric($positions[0])) {
            return null;
        }
        return new Position($positions[0], $positions[1]);
    } catch (Exception $e) {
        return null;
    }
}

function println(string $message, $withLn = true) {
    if ($withLn) {
        echo $message, PHP_EOL;
    }
    else {
        echo $message;
    }
}

println('######## Welcome to ic-tac-toe ########');

while (true) {
    println($board->toString());

    println("next player: {$currentStone}");
    println('enter (x,y) to put stone: ', false);
    $input = fgets(STDIN);

    $position = nextPosition($input);

    if (!$position) {
        println('SOMETHING WRONG.');
        continue;
    }


    if (!$board->isEmpty($position)) {
        println('CANT PUT HERE.');
        continue;
    }
    $board->put($position, $currentStone);

    $currentStone = $currentStone->turn();
}

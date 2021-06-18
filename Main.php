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

while (true) {
    echo $board->toString(), PHP_EOL;

    echo 'ENTER POSITION(x,y):';
    $input = fgets(STDIN);

    $position = nextPosition($input);

    if (!$position) {
        echo 'SOMETHING WRONG.', PHP_EOL;
        continue;
    }


    if (!$board->isEmpty($position)) {
        echo 'CANT PUT HERE.', PHP_EOL;
        continue;
    }
    $board->put($position, $currentStone);

    $currentStone = $currentStone->turn();
}

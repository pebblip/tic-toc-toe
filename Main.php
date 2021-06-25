<?php

require __DIR__ . '/vendor/autoload.php';

use Pebblip\AlgorithmType;
use Pebblip\Board;
use Pebblip\ComputerAlgorithm;
use Pebblip\ComputerPlayer;
use Pebblip\HumanPlayer;
use Pebblip\Player;
use Pebblip\Stone;

function println(string $message, $withLn = true) {
    if ($withLn) {
        echo $message, PHP_EOL;
    }
    else {
        echo $message;
    }
}

function getBordSize() {
    println("ゲーム盤の大きさを入力してください: ", false);

    $bordSize = trim(fgets(STDIN));

    if (!is_numeric($bordSize) || $bordSize < 1) {
        println("１より大きい整数を入力してください。");
        return getBordSize();
    }

    return $bordSize;
}

function createPlayers(ComputerAlgorithm $algorithm) : callable
{
    $player1 = new HumanPlayer(Stone::BLACK(), STDIN, STDOUT);
    $player2 = new ComputerPlayer(Stone::WHITE(), $algorithm, 1);

    $players = [$player1, $player2];

    return function () use (&$players) : Player {
        $player = array_shift($players);
        $players[] = $player;

        return $player;
    };
}

function chooseAlgorithmType()
{
    println("以下の中からコンピュータのアルゴリズムを選択してください");
    foreach (AlgorithmType::all() as $algorithmType) {
        println("{$algorithmType->code()}: {$algorithmType->description()}");
    }

    $codeList = array_map(function (AlgorithmType $type) { return $type->code(); }, AlgorithmType::all());
    $codeListText = implode(',', $codeList);
    println("コンピュータのアルゴリズム（{$codeListText}）: ", false);
    $code = trim(fgets(STDIN));

    if (array_search($code, $codeList) === false) {
        chooseAlgorithmType();
    }

    return AlgorithmType::ofCode($code);
}


println('######## オセロもどきのゲームにようこそ ########');

$boardSize = getBordSize();

$board = Board::make($boardSize);

$algorithmType = chooseAlgorithmType();

$changePlayer = createPlayers($algorithmType->algorithm());

$currentPlayer = $changePlayer();

while (true) {
    println($board->toString());

    if (!$board->hasEmpty()) {
        println('ゲーム終了');
        $blackCount = $board->count(Stone::BLACK());
        $whiteCount = $board->count(Stone::WHITE());
        println("黒: {$blackCount}, 白 : {$whiteCount}");

        if ($blackCount > $whiteCount) {
            println("あなたの勝ち！");
        }
        else if ($blackCount < $whiteCount) {
            println("コンピュータの勝ち");
        }
        else {
            println("引き分け");
        }
        break;
    }

    $position = $currentPlayer->nextPosition($board);

    if (!$board->isEmpty($position)) {
        println('ここには石を置けません。');
        continue;
    }

    $board->put($position, $currentPlayer->stone());

    $currentPlayer = $changePlayer();
}

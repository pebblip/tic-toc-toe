<?php


namespace Pebblip;

use Pebblip\Algorithm\FirstTurnOverAlgorithm;
use Pebblip\Algorithm\MostTurnOverAlgorithm;
use Pebblip\Algorithm\RandomAlgorithm;
use Pebblip\Algorithm\SequentialAlgorithm;

/**
 * アルゴリズムの種類
 *
 * Class AlgorithmType
 *
 * @package Pebblip
 */
class AlgorithmType
{
    private int $code;
    private string $description;
    private ComputerAlgorithm $algorithm;

    /**
     * AlgorithmType constructor.
     *
     * @param int               $code
     * @param string            $description
     * @param ComputerAlgorithm $algorithm
     */
    public function __construct(
        int $code,
        string $description,
        ComputerAlgorithm $algorithm
    ) {
        $this->code = $code;
        $this->description = $description;
        $this->algorithm = $algorithm;
    }


    /**
     * 空いているセルをランダムに選ぶアルゴリズム。
     *
     * @return AlgorithmType
     */
    public static function RANDOM(): AlgorithmType
    {
        return new AlgorithmType(1, '空いているセルをランダムに選びます。',
            new RandomAlgorithm());
    }

    /**
     * 空いている最初のセルを選ぶアルゴリズム。
     * @return AlgorithmType
     */
    public static function SEQUENTIAL(): AlgorithmType
    {
        return new AlgorithmType(2, '空いている最初のセルを選びます。',
            new SequentialAlgorithm());
    }

    /**
     * 相手の石をひっくり返せることができる最初のセルを選ぶアルゴリズム。
     *
     * ひっくり返せるセルがない場合、最初の空きセルを返す。
     *
     * @return AlgorithmType
     */
    public static function FIST_TURNOVER(): AlgorithmType
    {
        return new AlgorithmType(3,
            '相手の石をひっくり返せることができる最初のセルを選びます。ひっくり返せるセルがない場合、最初の空きセルを返します。',
            new FirstTurnOverAlgorithm());
    }

    /**
     * 相手の石を最もひっくり返すことができるセルを選ぶアルゴリズム。
     *
     * ひっくり返せるセルがない場合、最初の空きセルを返す。
     *
     * @return AlgorithmType
     */
    public static function MOST_TURNOVER(): AlgorithmType
    {
        return new AlgorithmType(4,
            '相手の石を最もひっくり返すことができるセルを選びます。ひっくり返せるセルがない場合、最初の空きセルを返します。',
            new MostTurnOverAlgorithm());
    }

    /**
     * @return string
     */
    public function code(): string
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function description(): string
    {
        return $this->description;
    }

    /**
     * @return ComputerAlgorithm
     */
    public function algorithm(): ComputerAlgorithm
    {
        return $this->algorithm;
    }

    /**
     * @param int $code
     *
     * @return AlgorithmType
     */
    public static function ofCode(int $code): AlgorithmType
    {
        return [
            self::RANDOM()->code() => self::RANDOM(),
            self::SEQUENTIAL()->code() => self::SEQUENTIAL(),
            self::FIST_TURNOVER()->code() => self::FIST_TURNOVER(),
            self::MOST_TURNOVER()->code() => self::MOST_TURNOVER(),
        ][$code];
    }

    /**
     * @return AlgorithmType[]
     */
    public static function all(): array
    {
        return [
            self::RANDOM(),
            self::SEQUENTIAL(),
            self::FIST_TURNOVER(),
            self::MOST_TURNOVER(),
        ];
    }
}

<?php

namespace Pebblip;


/**
 * 方向を表します。
 *
 * @package Pebblip
 */
class Direction
{
    /**
     * @var string
     */
    private string $direction;

    private function __construct(string $direction)
    {
        $this->direction = $direction;
    }

    /**
     * @return Direction 上
     */
    public static function T(): Direction
    {
        return new Direction('t');
    }

    /**
     * @return Direction 右上
     */
    public static function TR(): Direction
    {
        return new Direction('tr');
    }

    /**
     * @return Direction 右
     */
    public static function R(): Direction
    {
        return new Direction('r');
    }

    /**
     * @return Direction 右下
     */
    public static function BR(): Direction
    {
        return new Direction('br');
    }

    /**
     * @return Direction 下
     */
    public static function B(): Direction
    {
        return new Direction('b');
    }

    /**
     * @return Direction 左下
     */
    public static function BL(): Direction
    {
        return new Direction('bl');
    }

    /**
     * @return Direction 左
     */
    public static function L(): Direction
    {
        return new Direction('l');
    }

    /**
     * @return Direction 左上
     */
    public static function TL(): Direction
    {
        return new Direction('tl');
    }

    /**
     * 全ての方向を返します。
     * @return Direction[]
     */
    public static function all(): array
    {
        return [
            self::T(),
            self::TR(),
            self::R(),
            self::BR(),
            self::B(),
            self::BL(),
            self::L(),
            self::TL(),
        ];
    }

    /**
     * 逆方向を返します。
     *
     * @return Direction
     */
    public function opposite(): Direction
    {
        return [
            self::T()->code() => self::B(),
            self::TR()->code() => self::BL(),
            self::R()->code() => self::L(),
            self::BR()->code() => self::TL(),
            self::B()->code() => self::T(),
            self::BL()->code() => self::TR(),
            self::L()->code() => self::R(),
            self::TL()->code() => self::BR(),
        ][$this->code()];
    }

    /**
     * @return string
     */
    public function code(): string
    {
        return $this->direction;
    }
}

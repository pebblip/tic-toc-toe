<?php


namespace Pebblip;


class Stone
{
    /**
     * @var string
     */
    private string $color;

    private function __construct(string $color) {
        $this->color = $color;
    }

    public static function WHITE() : Stone {
        return new Stone('white');
    }

    public static function BLACK() : Stone {
        return new Stone('black');
    }

    /**
     * 石を反転します。
     * @return Stone
     */
    public function turn() : Stone {
        switch ($this) {
            case self::BLACK(): return self::WHITE();
            case self::WHITE(): return self::BLACK();
        }
        //ありえない
        throw new \RuntimeException('something wrong...');
    }

    /**
     * @param Stone $other
     *
     * @return bool
     */
    public function eq(Stone $other) : bool {
        return $this->color === $other->color;
    }

    public function __toString() : string {
        switch ($this) {
            case Stone::BLACK() : return '●';
            case Stone::WHITE() : return '○';
        }
    }
}

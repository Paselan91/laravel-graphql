<?php

declare(strict_types=1);

namespace App\Domain\ValueObjects\Type;

use Exception;

/**
 * 文字列の基底クラス
 */
abstract class StringValueObjectAbstract
{
    /** @var int 最大文字数 */
    protected const MAX_STRING = 255;

    /** @var int 最小文字数 */
    protected const MIN_STRING = 1;

    /**
     * @param string $value
     * @return void
     */
    public function validate(
        string $value,
        string $variableName
    ): void {
        $minString = static::MIN_STRING;
        $maxString = static::MAX_STRING;

        $string = mb_strlen($value, 'UTF-8');
        if ($string < $minString || $string > $maxString) {
            throw new Exception("{$minString}文字以上{$maxString}文字以内で入力されていないのでエラーが発生しました。", "{$variableName}は{$minString}文字以上{$maxString}文字以内で入力してください。");
        }
    }

    /**
     * @return int
     */
    public static function maxString(): int
    {
        return static::MAX_STRING;
    }

    /**
     * @return int
     */
    public static function minString(): int
    {
        return static::MIN_STRING;
    }
}

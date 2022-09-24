<?php

declare(strict_types=1);

namespace App\Domain\Shared\ValueObjects\Type;

use Exception;

/**
 * 文字列タイプの基底クラス
 */
abstract class StringTypeAbstract
{
    /** 最大文字数 */
    public const MAX = 255;

    /**  最小文字数 */
    public const MIN = 1;

    /**
     * @param  string $variableName 変数名
     * @param  string $value        値
     * @return void
     */
    public function validate(
        string $variableName,
        string $value
    ): void {
        $min = static::MIN;
        $max = static::MAX;

        $charas = mb_strlen($value, 'UTF-8');
        if ($charas < $min || $charas > $max) {
            throw new Exception("{$min}文字以上{$max}文字以内で入力されていないのでエラーが発生しました。{$variableName}は{$min}文字以上{$max}文字以内で入力してください。");
        }
    }
}

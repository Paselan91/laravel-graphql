<?php

declare(strict_types=1);

namespace App\Domain\ValueObjects\Type;

use Exception;

/**
 * IDタイプの基底クラス
 */
abstract class IdTypeAbstract
{
    /**  最小数 */
    public const MIN = 1;

    /**
     * @param string $variableName 変数名
     * @param string $value 値
     * @return void
     */
    public function validate(
        string $variableName,
        int $value
    ): void {
        $min = static::MIN;

        if ($value < $min) {
            throw new Exception("{$variableName}は{$min}文字以上で入力してください。value:{$value}");
        }
    }
}

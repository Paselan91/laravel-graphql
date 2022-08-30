<?php

declare(strict_types=1);

namespace App\Domain\ValueObjects\Type;

use Exception;

/**
 * Booleanタイプの基底クラス
 */
abstract class BoolTypeAbstract
{
    /**
     * @param string $variableName 変数名
     * @param bool $value 値
     * @return void
     */
    public function validate(
        string $variableName,
        bool $value
    ): void {
        // TODO: boolだと何もすることがないよ？
    }
}

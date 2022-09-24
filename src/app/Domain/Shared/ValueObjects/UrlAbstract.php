<?php

declare(strict_types=1);

namespace App\Domain\ValueObjects\Type;

use App\Domain\Shared\ValueObjects\Type\StringTypeAbstract;

/**
 * URLの基底クラス
 */
abstract class UrlAbstract extends StringTypeAbstract
{
    /** 最大文字数 */
    public const MAX = 255;

    /**  最小文字数 */
    public const MIN = 1;

    /**  URLの正規表現 TODO:*/
    public const URL_REGEX = 'regexの実装';

    /**
     * @param  string $variableName 変数名
     * @param  string $value        値
     * @return void
     */
    public function validate(
        string $variableName,
        string $value
    ): void {
        parent::validate($variableName, $value);
        $this->isUrlType($value);
    }

    /**
     * @param  string $value
     * @return bool
     */
    private function isUrlType(string $value): bool
    {
        // TODO: regexの実装
        return true;
    }
}

<?php

declare(strict_types=1);

namespace App\Domain\ValueObjects\Type;

use Exception;

/**
 * URLの基底クラス
 */
abstract class UrlAbstract extends StringAbstract
{
    /** 最大文字数 */
    public const MAX = 255;

    /**  最小文字数 */
    public const MIN = 1;

    /**  URLの正規表現 TODO:*/
    public const URL_REGEX = 'あとで書く';

    /**
     * @param string $variableName 変数名
     * @param string $value 値
     * @return void
     */
    public function validate(
        string $variableName,
        string $value
    ): void {
        $this->validate($variableName, $value);
    }

    private function isUrlType(string $value) bool
    {
        // TODO: あとでかく
        return true;
    }
}

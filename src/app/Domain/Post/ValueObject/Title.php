<?php

declare(strict_types=1);

namespace App\Domain\Post\ValueObject;

use App\Domain\Shared\ValueObjects\Type\StringTypeAbstract;

/**
 * タイトル
 */
final class Title extends StringTypeAbstract
{
    public const VARIABLE_NAME = 'タイトル';

    /** 最大文字数 */
    public const MAX = 100;

    /**  最小文字数 */
    public const MIN = 1;

    /**
     * @param string $value
     */
    public function __construct(
        private string $value
    ) {
        $this->validate(self::VARIABLE_NAME, $value);
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->value;
    }
}

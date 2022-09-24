<?php

declare(strict_types=1);

namespace App\Domain\User\ValueObject;

use App\Domain\Shared\ValueObjects\Type\StringTypeAbstract;

/**
 * メールアドレス
 */
final class Email extends StringTypeAbstract
{
    public const VARIABLE_NAME = 'メールアドレス';

    /** 最大文字数 */
    public const MAX = 255;

    /**  最小文字数 */
    public const MIN = 1;

    /**
     * @param string $value
     */
    public function __construct(
        private string $value
    ) {
        $this->validate(self::VARIABLE_NAME, $value);

        // TODO: メールアドレスの正規表現
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->value;
    }
}

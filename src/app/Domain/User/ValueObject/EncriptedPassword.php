<?php

declare(strict_types=1);

namespace App\Domain\User\ValueObject;

use App\Domain\Shared\ValueObjects\Type\StringTypeAbstract;

/**
 * パスワード（暗号化）
 */
final class EncriptedPassword extends StringTypeAbstract
{
    public const VARIABLE_NAME = 'パスワード（暗号化）';

    /**
     * @param string $value
     */
    public function __construct(
        private string $value
    ) {
        $this->validate(self::VARIABLE_NAME, $value);

        // TODO: パスワードの正規表現チェック
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->value;
    }
}

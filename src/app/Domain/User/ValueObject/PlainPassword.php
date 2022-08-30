<?php

declare(strict_types=1);

namespace App\Domain\User\ValueObject;

use App\Domain\ValueObjects\Type\StringAbstract;
use App\Exceptions\GraphQL\ValueObjectException;

/**
 * パスワード（平文）
 */
final class PlainPassword extends StringAbstract
{
    public const VARIABLE_NAME = 'パスワード（平文）';

    /**
     * @param string $value
     */
    public function __construct(
        private string $value
    ) {
        $this->validate(self::VARIABLE_NAME, $value);

        // TODO: パスワードの正規表現

        $this->value = $value;
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->value;
    }
}

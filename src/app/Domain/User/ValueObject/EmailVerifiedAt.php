<?php

declare(strict_types=1);

namespace App\Domain\User\ValueObject;

use App\Domain\ValueObjects\Type\StringAbstract;
use App\Exceptions\GraphQL\ValueObjectException;

/**
 * メールアドレス認証日時
 */
final class EmailVerifiedAt extends StringAbstract
{
    public const VARIABLE_NAME = 'メールアドレス認証日時';

    /**
     * @param string $value
     */
    public function __construct(
        private string $value
    ) {
        $this->validate(self::VARIABLE_NAME, $value);

        // TODO: メールアドレスの正規表現

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

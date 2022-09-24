<?php

declare(strict_types=1);

namespace App\Domain\User\ValueObject;

use Carbon\CarbonImmutable;

/**
 * メールアドレス認証日時
 */
final class EmailVerifiedAt
{
    public const VARIABLE_NAME = 'メールアドレス認証日時';

    /**
     * @param CarbonImmutable $value
     */
    public function __construct(
        private CarbonImmutable $value
    ) {
    }

    /**
     * @return CarbonImmutable
     */
    public function value(): CarbonImmutable
    {
        return $this->value;
    }
}

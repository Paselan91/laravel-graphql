<?php

declare(strict_types=1);

namespace App\Domain\Post\ValueObject;

use App\Domain\ValueObjects\Type\IdTypeAbstract;
use App\Domain\ValueObjects\Type\StringAbstract;
use App\Exceptions\GraphQL\ValueObjectException;

/**
 * ユーザーID
 */
final class UserId extends IdTypeAbstract
{
    public const VARIABLE_NAME = 'ユーザーID';

    /**  最小文字数 */
    public const MIN = 1;

    /**
     * @param string $value
     */
    public function __construct(
        private string $value
    ) {
        parent::validate(self::VARIABLE_NAME, $value);

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

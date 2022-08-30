<?php

declare(strict_types=1);

namespace App\Domain\Post\ValueObject;

use App\Domain\ValueObjects\Type\UrlAbstract;
use App\Domain\ValueObjects\Type\BoolAbstract;
use App\Domain\ValueObjects\Type\StringAbstract;
use App\Exceptions\GraphQL\ValueObjectException;

/**
 * 公開状態か
 */
final class IsPublic extends BoolAbstract
{
    public const VARIABLE_NAME = '公開状態か';

    public const IS_PUBLIC = true;

    public const NOT_PUBLIC = false;

    private const VALUE_NAME = [
        self::IS_PUBLIC  => '公開',
        self::NOT_PUBLIC => '非公開',
    ];

    /**
     * @param bool $value
     */
    public function __construct(
        private bool $value
    ) {
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getValueName(): string
    {
        return self::VALUE_NAME[$this->value];
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->value;
    }
}

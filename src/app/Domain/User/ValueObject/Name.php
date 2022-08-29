<?php

declare(strict_types=1);

namespace App\Domain\User\ValueObject;

use App\Domain\ValueObjects\Type\StringValueObjectAbstract;
use App\Exceptions\GraphQL\ValueObjectException;

/**
 * 氏名
 */
final class NameValue extends StringValueObjectAbstract
{
    private const VARIABLE_NAME = '氏名';

    private const MAX_STRING = 50;

    private const MIN_STRING = 1;

    /**
     * @param string $name
     */
    public function __construct(
        private string $name
    ) {
        $variableName = self::VARIABLE_NAME;

        $string = mb_strlen($name, 'UTF-8');
        $min = self::MIN_STRING;
        $max = self::MAX_STRING;

        if ($string < $min || $string > $max) {
            throw new ValueObjectException("{$variableName}は{$min}文字以上{$max}文字以内で入力してください。");
        }

        $this->name = $name;
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public static function displayVariableName(): string
    {
        return self::VARIABLE_NAME;
    }

    /**
     * @return int
     */
    public static function maxString(): int
    {
        return self::MAX_STRING;
    }

    /**
     * @return int
     */
    public static function minString(): int
    {
        return self::MIN_STRING;
    }
}

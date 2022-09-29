<?php

declare(strict_types=1);

namespace App\GraphQL\User\Query\FetchUserByIdQuery;

use App\Domain\User\Entity\UserEntity;
use Exception;
use Illuminate\Support\Facades\Validator;

final class FetchUserByIdInput
{
    /**
     * @param int $id
     */
    private function __construct(
        private int $id
    ) {
    }

    /**
     * @param  array<string, int> $args
     * @return self
     */
    public static function build(array $args): self
    {
        self::validate($args);

        return new self(
            (int) $args['id']
        );
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return void
     */
    private static function validate(array $args): void
    {
        Validator::make($args,
            self::rules(),
            self::attributes(),
        )->validate();
    }

    /**
     * @return array<string, array<mixed>>
     */
    private static function rules(): array
    {
        return [
            'id' => ['exists:users,id'],
        ];
    }

    /**
     * @return array<string, string>
     */
    private static function attributes(): array
    {
        $userNmae = UserEntity::NAME;

        return [
            'id' => "{$userNmae}ID"
        ];
    }
}

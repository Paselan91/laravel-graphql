<?php

declare(strict_types=1);

namespace App\GraphQL\User\Validator;

use App\Domain\User\Entity\UserEntity;
use Nuwave\Lighthouse\Validation\Validator;

final class FetchUserByIdInputValidator extends Validator
{
    /**
     * @return array<string, array<mixed>>
     */
    public function rules(): array
    {
        return [
            'id' => ['exists:users,id'],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        $userNmae = UserEntity::NAME;

        return [
            'id' => "{$userNmae}ID"
        ];
    }
}

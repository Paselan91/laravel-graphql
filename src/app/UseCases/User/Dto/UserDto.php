<?php

declare(strict_types=1);

namespace App\UseCases\User\Dto;

use App\Domain\User\Entity\UserEntity;
use App\Infrastructure\Models\User;
use Exception;

/**
 * ユーザー
 */
final class UserDto
{
    /**
     * @param  UserEntity $userEntity
     * @return User
     */
    public function toModel(UserEntity $userEntity): User
    {
        $variableName = UserEntity::NAME;

        $user = new User();

        if (is_null($userEntity->getId())) {
            throw new Exception("{$variableName}エンティティ ID が NULL です");
        }
        $user->id = $userEntity->getId();

        $user->name = $userEntity->getName()->value();
        $user->email = $userEntity->getEmail()->value();
        $user->email_verified_at = $userEntity->getEmailVerifiedAt()->value()->toMutable();

        if (is_null($userEntity->getEncriptedPassword())) {
            throw new Exception("{$variableName}エンティティ encriptedPassword が NULL です");
        }
        $user->password = $userEntity->getEncriptedPassword()->value();

        return $user;
    }
}

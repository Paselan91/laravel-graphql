<?php

declare(strict_types=1);

namespace App\UseCases\User\Dto;

use App\Domain\User\Entity\UserEntity;
use App\Infrastructure\Models\User;

/**
 * ユーザー
 */
final class UserDto
{
    /**
     * @param UserEntity $userEntity
     * @return User
     */
    public function toModel(UserEntity $userEntity): User
    {
        $user = new User();
        $user->id = (int) $userEntity->getId();
        $user->user_sub_id = (string) $userEntity->getUserSubId()->value();
        $user->name = $userEntity->getName()->value();
        $user->birthday = $userEntity->getBirthday()->strValue();
        $user->is_birthday_public = $userEntity->getIsBirthdayPublic()->value();
        $user->is_public = $userEntity->getIsPublic()->value();
        $user->total_favorite = $userEntity->getTotalFavorite()->value();
        $user->total_nice = $userEntity->getTotalNice()->value();

        return $user;
    }
}

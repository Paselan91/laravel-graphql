<?php

declare(strict_types=1);

namespace App\Infrastructure\Repositories\User;

use App\Domain\User\Entity\UserEntity;
use App\Domain\User\Repository\UserRepositoryInterface;
use App\Infrastructure\Models\User;
use Exception;

final class UserRepository implements UserRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function store(UserEntity $userEntity): int
    {
        $param = [
            'name'              => $userEntity->getName()->value(),
            'email'             => $userEntity->getEmail()->value(),
            'email_verified_at' => $userEntity->getEmailVerifiedAt()->value(),
            'password'          => $userEntity->getEncriptedPassword()?->value(),
        ];

        $userModel = User::updateOrCreate(
            ['id' => $userEntity->getId()],
            $param
        );

        return $userModel->id;
    }

    /**
     * @inheritDoc
     */
    public function findById(int $userId): UserEntity
    {
        try {
            $user = User::findOrFail($userId);
        } catch (Exception $e) {
            $entityName = UserEntity::NAME;

            throw new Exception("指定された{$entityName}が見つかりませんでした。ID:{$userId} err:{$e->getMessage()}");
        }

        return $user->toEntity();
    }

    /**
     * @inheritDoc
     */
    public function findByIdRelations(
        int $userId,
        array $relations = [],
    ): UserEntity {
        try {
            $user = User::with($relations)->findOrFail($userId);
        } catch (Exception $e) {
            $variableName = UserEntity::NAME;

            throw new Exception("指定された{$variableName}が見つかりませんでした。ID:{$userId} err:{$e->getMessage()}");
        }

        return $user->toEntity();
    }

    /**
     * @inheritDoc
     */
    public function findByIdWhere(
        int $userId,
        array $where = [],
    ): UserEntity {
        try {
            $user = User::where($where)->findOrFail($userId);
        } catch (Exception $e) {
            $variableName = UserEntity::NAME;

            throw new Exception("指定された{$variableName}が見つかりませんでした。ID:{$userId} err:{$e->getMessage()}");
        }

        return $user->toEntity();
    }
}

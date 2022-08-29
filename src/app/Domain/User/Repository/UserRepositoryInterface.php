<?php

declare(strict_types=1);

namespace App\Domain\User\Repository;

use App\Domain\User\Entity\UserEntity;

/**
 * ユーザー
 */
interface UserRepositoryInterface
{
    /**
     * ユーザーを保存
     *
     * @param UserEntity $userEntity
     * @return int
     */
    public function store(UserEntity $userEntity): int;

    /**
     * IDから取得
     *
     * @param int $userId
     * @return UserEntity
     */
    public function findById(int $userId): UserEntity;

    /**
     * 指定された条件をリレーションし、IDから取得
     *
     * @param int $userId
     * @param string[] $withRelations リレーション条件
     * @return UserEntity
     */
    public function findByIdWithRelations(
        int $userId,
        array $withRelations = []
    ): UserEntity;
}

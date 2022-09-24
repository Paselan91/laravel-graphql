<?php

declare(strict_types=1);

namespace App\Domain\User\Repository;

use App\Domain\User\Entity\UserEntity;

interface UserRepositoryInterface
{
    /**
     * 新規作成/更新
     *
     * @param  UserEntity $userEntity
     * @return int        ユーザーID
     */
    public function store(UserEntity $userEntity): int;

    /**
     * IDから取得
     *
     * @param  int        $userId ユーザーID
     * @return UserEntity ユーザーエンティティ
     */
    public function findById(int $userId): UserEntity;

    /**
     * IDから取得（指定された条件をリレーション）
     *
     * @param  int        $userId    ユーザーID
     * @param  string[]   $relations リレーション条件
     * @return UserEntity ユーザーエンティティ
     */
    public function findByIdRelations(
        int $userId,
        array $relations = []
    ): UserEntity;

    /**
     * IDから取得（指定された条件で絞り込み）
     *
     * @param  int        $userId ユーザーID
     * @param  string[]   $where  絞り込み条件
     * @return UserEntity ユーザーエンティティ
     */
    public function findByIdWhere(
        int $userId,
        array $where = []
    ): UserEntity;
}

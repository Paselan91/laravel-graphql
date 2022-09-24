<?php

declare(strict_types=1);

namespace App\Domain\Post\Repository;

use App\Domain\Post\Entity\PostEntity;

interface PostRepositoryInterface
{
    /**
     * 新規作成/更新
     *
     * @param  PostEntity $postEntity 投稿エンティティ
     * @return int        投稿ID
     */
    public function store(PostEntity $postEntity): int;

    /**
     * IDから取得
     *
     * @param  int        $postId 投稿ID
     * @return PostEntity 投稿エンティティ
     */
    public function findById(int $postId): PostEntity;

    /**
     * IDから取得（指定された条件をリレーション）
     *
     * @param  int        $postId    投稿ID
     * @param  string[]   $relations リレーション条件
     * @return PostEntity 投稿エンティティ
     */
    public function findByIdRelations(
        int $postId,
        array $relations = []
    ): PostEntity;

    /**
     * IDから取得（指定された条件で絞り込み）
     *
     * @param  int        $postId 投稿ID
     * @param  string[]   $where  絞り込み条件
     * @return PostEntity 投稿エンティティ
     */
    public function findByIdWhere(
        int $postId,
        array $where = []
    ): PostEntity;
}

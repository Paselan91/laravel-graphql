<?php

declare(strict_types=1);

namespace App\Infrastructure\Repositories\Post;

use App\Domain\Post\Entity\PostEntity;
use App\Domain\Post\Repository\PostRepositoryInterface;
use App\Infrastructure\Models\Post;
use Exception;

final class PostRepository implements PostRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function store(PostEntity $postEntity): int
    {
        $param = [
            'user_id'                 => $postEntity->getUserId(),
            'title'                   => $postEntity->getTitle()->value(),
            'body'                    => $postEntity->getBody()->value(),
            'top_image_path'          => $postEntity->getTopImagePath()?->value(),
            'is_public'               => $postEntity->getIsPublic()->value(),
        ];

        $PostModel = Post::updateOrCreate(
            ['id' => $postEntity->getId()],
            $param
        );

        return $PostModel->id;
    }

    /**
     * @inheritDoc
     */
    public function findById(int $PostId): PostEntity
    {
        try {
            $Post = Post::findOrFail($PostId);
        } catch (Exception $e) {
            $entityName = PostEntity::NAME;

            throw new Exception("指定された{$entityName}が見つかりませんでした。ID:{$PostId} err:{$e->getMessage()}");
        }

        return $Post->toEntity();
    }

    /**
     * @inheritDoc
     */
    public function findByIdRelations(
        int $PostId,
        array $relations = [],
    ): PostEntity {
        try {
            $Post = Post::with($relations)->findOrFail($PostId);
        } catch (Exception $e) {
            $variableName = PostEntity::NAME;

            throw new Exception("指定された{$variableName}が見つかりませんでした。ID:{$PostId} err:{$e->getMessage()}");
        }

        return $Post->toEntity();
    }

    /**
     * @inheritDoc
     */
    public function findByIdWhere(
        int $PostId,
        array $where = [],
    ): PostEntity {
        try {
            $Post = Post::where($where)->findOrFail($PostId);
        } catch (Exception $e) {
            $variableName = PostEntity::NAME;

            throw new Exception("指定された{$variableName}が見つかりませんでした。ID:{$PostId} err:{$e->getMessage()}");
        }

        return $Post->toEntity();
    }
}

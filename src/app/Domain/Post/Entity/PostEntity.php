<?php

declare(strict_types=1);

namespace App\Domain\Post\Entity;

use App\Domain\Post\ValueObject\Body;
use App\Domain\Post\ValueObject\IsPublic;
use App\Domain\Post\ValueObject\Title;
use App\Domain\Post\ValueObject\TopImagePath;

/**
 * 投稿
 */
final class PostEntity
{
    public const NAME = '投稿';

    /**
     * @param int|null          $id
     * @param int               $userId
     * @param Title             $title
     * @param Body              $body
     * @param TopImagePath|null $topImagePath
     * @param IsPublic          $isPublic
     */
    private function __construct(
        private ?int $id,
        private int $userId,
        private Title $title,
        private Body $body,
        private ?TopImagePath $topImagePath,
        private IsPublic $isPublic,
    ) {
    }

    /**
     * @param  array<string, int|string|bool> $args
     * @return self
     */
    public static function create(array $args): self
    {
        $topImagePath = array_key_exists('top_image_path', $args)
            ? new TopImagePath((string) $args['top_image_path'])
            : null;

        return new self(
            null,
            (int) $args['user_id'],
            new Title((string) $args['title']),
            new Body((string) $args['title']),
            $topImagePath,
            new IsPublic((bool) $args['is_public']),
        );
    }

    /**
     * @param  int|null          $id
     * @param  int               $userId
     * @param  Title             $title
     * @param  Body              $body
     * @param  TopImagePath|null $topImagePath
     * @param  IsPublic          $isPublic
     * @return self
     */
    public static function reconstruct(
        ?int $id,
        int $userId,
        Title $title,
        Body $body,
        ?TopImagePath $topImagePath,
        IsPublic $isPublic
    ): self {
        return new self(
            $id,
            $userId,
            $title,
            $body,
            $topImagePath,
            $isPublic
        );
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @return Title
     */
    public function getTitle(): Title
    {
        return $this->title;
    }

    /**
     * @return Body
     */
    public function getBody(): Body
    {
        return $this->body;
    }

    /**
     * @return TopImagePath|null
     */
    public function getTopImagePath(): ?TopImagePath
    {
        return $this->topImagePath;
    }

    /**
     * @return IsPublic
     */
    public function getIsPublic(): IsPublic
    {
        return $this->isPublic;
    }
}

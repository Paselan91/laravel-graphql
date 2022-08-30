<?php

declare(strict_types=1);

namespace App\Domain\User\Entity;

use Faker\Guesser\Name;
use Carbon\CarbonImmutable;
use App\Domain\User\ValueObject\Email;
use App\Domain\User\ValueObject\PlainPassword;
use App\Domain\User\ValueObject\EmailVerifiedAt;
use App\Domain\User\ValueObject\NameValueObject;
use App\Domain\User\ValueObject\EncriptedPassword;
use App\Domain\User\ValueObject\BirthdayValueObject;
use App\Domain\User\ValueObject\IsPublicValueObject;
use App\Domain\UserImage\Entity\UserImageEntityList;
use App\Domain\UserProfile\Entity\UserProfileEntity;
use App\Domain\User\ValueObject\TotalNiceValueObject;
use App\Domain\User\ValueObject\UserSubIdValueObject;
use App\Domain\User\ValueObject\TotalFavoriteValueObject;
use App\Domain\UserCredential\Entity\UserCredentialEntity;
use App\Domain\User\ValueObject\IsBirthdayPublicValueObject;
use App\Domain\UserMailNotificationSetting\Entity\UserMailNotificationSettingEntity;

/**
 * 投稿
 */
final class PostEntity
{
    public const NAME = '投稿';

    private function __construct(
        private ?int $id,
        private UserId $userId,
        private Title $title,
        private Body $body,
        private ?TopImagePath $topImagePath,
    ) {
    }

    /**
     * @param array $args
     * @return self
     */
    public function create(array $args): self
    {
        return new self(
            null,
            $args['user_id'],
            $args['title'],
            $args['body'],
            $args['top_image_path'],
        );
    }

    public function reconstruct(
        ?int $id,
        UserId $userId,
        Title $title,
        Body $body,
        ?TopImagePath $topImagePath
    ): self {
        return new self(
            $id,
            $userId,
            $title,
            $body,
            $topImagePath
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
     * @return UserId
     */
    public function getUserId(): UserId
    {
        return $this->userId;
    }

    /**
     * @return Title
     */
    public function getTitle(): Email
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
    public function getTopImagePath(): TopImagePath
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

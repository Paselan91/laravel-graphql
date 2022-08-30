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
 * ユーザー
 */
final class UserEntity
{
    public const NAME = 'ユーザー';

    private function __construct(
        private ?int $id,
        private Name $name,
        private Email $email,
        private EmailVerifiedAt $emailVerifiedAt,
        private ?EncriptedPassword $encriptedPassword,
        private ?PlainPassword $plainPassword,
    ) {
    }

    /**
     * @param array $args
     * @return self
     */
    public function create(array $args): self {
        return new self(
            null,
            $args['name'],
            $args['email'],
            $args['email_verified_at'],
            $args['encripted_password'],
            $args['plain_password'],
        );
    }

    public function reconstruct(
        int $id,
        Name $name,
        Email $email,
        EncriptedPassword $encriptedPassword,
        PlainPassword $plainPassword
    ): self {
        return new self(
            $id,
            $name,
            $email,
            $encriptedPassword,
            $plainPassword,
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
     * @return Name
     */
    public function getName(): Name
    {
        return $this->name;
    }

    /**
     * @return Email
     */
    public function getEmail(): Email
    {
        return $this->email;
    }

    /**
     * @return EmailVerifiedAt
     */
    public function getEmailVerifedAt(): EmailVerifiedAt
    {
        return $this->emailVerifedAt;
    }

    /**
     * @return EncriptedPassword
     */
    public function getEncriptedPassword(): EncriptedPassword
    {
        return $this->encriptedPassword;
    }

    /**
     * @return PlainPassword
     */
    public function getEncriptedPassword(): PlainPassword
    {
        return $this->plainPassword;
    }

    /**
     * 認証トークンのkeyを生成
     *
     * @param int $id
     * @return string
     */
    public function createTokenKey(int $id): string
    {
        return "userId:{$id}";
    }
}

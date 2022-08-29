<?php

declare(strict_types=1);

namespace App\Domain\User\Entity;

use App\Domain\User\ValueObject\BirthdayValueObject;
use App\Domain\User\ValueObject\IsBirthdayPublicValueObject;
use App\Domain\User\ValueObject\IsPublicValueObject;
use App\Domain\User\ValueObject\NameValueObject;
use App\Domain\User\ValueObject\TotalFavoriteValueObject;
use App\Domain\User\ValueObject\TotalNiceValueObject;
use App\Domain\User\ValueObject\UserSubIdValueObject;
use App\Domain\UserCredential\Entity\UserCredentialEntity;
use App\Domain\UserImage\Entity\UserImageEntityList;
use App\Domain\UserMailNotificationSetting\Entity\UserMailNotificationSettingEntity;
use App\Domain\UserProfile\Entity\UserProfileEntity;
use Carbon\CarbonImmutable;

/**
 * ユーザー
 */
final class UserEntity
{
    private const VARIABLE_NAME = 'ユーザー';

    /**
     * @param int|null $id
     * @param UserSubIdValueObject $userSubId
     * @param NameValueObject $name
     * @param BirthdayValueObject $birthday
     * @param IsBirthdayPublicValueObject $isBirthdayPublic
     * @param IsPublicValueObject $isPublic
     * @param TotalFavoriteValueObject $totalFavorite
     * @param TotalNiceValueObject $totalNice
     * @param CarbonImmutable|null $createdAt
     * @param UserCredentialEntity|null $userCredential
     * @param UserProfileEntity|null $userProfile
     * @param UserMailNotificationSettingEntity|null $userMailNotificationSetting
     * @param UserImageEntityList|null $userImageList
     */
    public function __construct(
        private ?int $id,
        private UserSubIdValueObject $userSubId,
        private NameValueObject $name,
        private BirthdayValueObject $birthday,
        private IsBirthdayPublicValueObject $isBirthdayPublic,
        private IsPublicValueObject $isPublic,
        private TotalFavoriteValueObject $totalFavorite,
        private TotalNiceValueObject $totalNice,
        private ?CarbonImmutable $createdAt,
        private ?UserCredentialEntity $userCredential,
        private ?UserProfileEntity $userProfile,
        private ?UserMailNotificationSettingEntity $userMailNotificationSetting,
        private ?UserImageEntityList $userImageList,
    ) {
    }

    /**
     * @return string
     */
    public static function displayVariableName(): string
    {
        return self::VARIABLE_NAME;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return UserSubIdValueObject
     */
    public function getUserSubId(): UserSubIdValueObject
    {
        return $this->userSubId;
    }

    /**
     * @return NameValueObject
     */
    public function getName(): NameValueObject
    {
        return $this->name;
    }

    /**
     * @return BirthdayValueObject
     */
    public function getBirthday(): BirthdayValueObject
    {
        return $this->birthday;
    }

    /**
     * @return IsBirthdayPublicValueObject
     */
    public function getIsBirthdayPublic(): IsBirthdayPublicValueObject
    {
        return $this->isBirthdayPublic;
    }

    /**
     * @return IsPublicValueObject
     */
    public function getIsPublic(): IsPublicValueObject
    {
        return $this->isPublic;
    }

    /**
     * @return TotalFavoriteValueObject
     */
    public function getTotalFavorite(): TotalFavoriteValueObject
    {
        return $this->totalFavorite;
    }

    /**
     * @return TotalNiceValueObject
     */
    public function getTotalNice(): TotalNiceValueObject
    {
        return $this->totalNice;
    }

    /**
     * @return CarbonImmutable|null
     */
    public function getCreatedAt(): ?CarbonImmutable
    {
        return $this->createdAt;
    }

    /**
     * @return UserCredentialEntity|null
     */
    public function getUserCredential(): ?UserCredentialEntity
    {
        return $this->userCredential;
    }

    /**
     * @return UserProfileEntity|null
     */
    public function getUserProfile(): ?UserProfileEntity
    {
        return $this->userProfile;
    }

    /**
     * @return UserMailNotificationSettingEntity|null
     */
    public function getUserMailNotificationSetting(): ?UserMailNotificationSettingEntity
    {
        return $this->userMailNotificationSetting;
    }

    /**
     * @return UserImageEntityList|null
     */
    public function getUserImageList(): ?UserImageEntityList
    {
        return $this->userImageList;
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

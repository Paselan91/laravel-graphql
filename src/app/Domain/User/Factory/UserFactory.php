<?php

declare(strict_types=1);

namespace App\Domain\User\Factory;

use App\Domain\User\Entity\UserEntity;
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

final class UserFactory
{
    /**
     * @param array $args
     * @param UserCredentialEntity|null $userCredential
     * @param UserProfileEntity|null $userProfile
     * @param UserMailNotificationSettingEntity|null $userMailNotificationSetting
     * @param UserImageEntityList|null $userImageList
     * @return UserEntity
     */
    public function create(
        array $args,
        ?UserCredentialEntity $userCredential,
        ?UserProfileEntity $userProfile,
        ?UserMailNotificationSettingEntity $userMailNotificationSetting,
        ?UserImageEntityList $userImageList,
    ): UserEntity {
        $isBirthdayPublic = $args['is_birthday_public']
            ? new IsBirthdayPublicValueObject($args['is_birthday_public'])
            : new IsBirthdayPublicValueObject(IsBirthdayPublicValueObject::initialValue());

        $isPublic = $args['is_birthday_public']
            ? new IsPublicValueObject($args['is_birthday_public'])
            : new IsPublicValueObject(IsPublicValueObject::initialValue());

        $totalFavorite = isset($args['total_favorite'])
            ? new TotalFavoriteValueObject((int) $args['total_favorite'])
            : new TotalFavoriteValueObject(TotalFavoriteValueObject::initialValue());

        $totalNice = isset($args['total_nice'])
            ? new TotalNiceValueObject((int) $args['total_nice'])
            : new TotalNiceValueObject(TotalNiceValueObject::initialValue());

        return new UserEntity(
            null,
            new UserSubIdValueObject($args['user_sub_id']),
            new NameValueObject($args['name']),
            new BirthdayValueObject(CarbonImmutable::parse($args['birthday'])),
            $isBirthdayPublic,
            $isPublic,
            $totalFavorite,
            $totalNice,
            null,
            $userCredential,
            $userProfile,
            $userMailNotificationSetting,
            $userImageList
        );
    }

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
     * @return UserEntity
     */
    public function reconstruct(
        ?int $id,
        UserSubIdValueObject $userSubId,
        NameValueObject $name,
        BirthdayValueObject $birthday,
        IsBirthdayPublicValueObject $isBirthdayPublic,
        IsPublicValueObject $isPublic,
        TotalFavoriteValueObject $totalFavorite,
        TotalNiceValueObject $totalNice,
        ?CarbonImmutable $createdAt,
        ?UserCredentialEntity $userCredential,
        ?UserProfileEntity $userProfile,
        ?UserMailNotificationSettingEntity $userMailNotificationSetting,
        ?UserImageEntityList $userImageList,
    ): UserEntity {
        return new UserEntity(
            $id,
            $userSubId,
            $name,
            $birthday,
            $isBirthdayPublic,
            $isPublic,
            $totalFavorite,
            $totalNice,
            $createdAt,
            $userCredential,
            $userProfile,
            $userMailNotificationSetting,
            $userImageList
        );
    }
}

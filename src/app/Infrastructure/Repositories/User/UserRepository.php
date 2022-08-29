<?php

declare(strict_types=1);

namespace App\Infrastructure\Repositories\User;

use App\Domain\User\Entity\UserEntity;
use App\Domain\User\Repository\UserRepositoryInterface;
use App\Domain\UserCredential\Entity\UserCredentialEntity;
use App\Domain\UserCredential\Factory\UserCredentialFactory;
use App\Domain\UserCredential\Repository\UserCredentialRepositoryInterface;
use App\Domain\UserImage\Repository\UserImageRepositoryInterface;
use App\Domain\UserMailNotificationSetting\Entity\UserMailNotificationSettingEntity;
use App\Domain\UserMailNotificationSetting\Factory\UserMailNotificationSettingFactory;
use App\Domain\UserMailNotificationSetting\Repository\UserMailNotificationSettingRepositoryInterface;
use App\Domain\UserProfile\Entity\UserProfileEntity;
use App\Domain\UserProfile\Factory\UserProfileFactory;
use App\Domain\UserProfile\Repository\UserProfileRepositoryInterface;
use App\Exceptions\GraphQL\RecordsNotFoundException;
use App\Infrastructure\Models\User;
use App\Infrastructure\Models\UserCredential;
use App\Infrastructure\Models\UserProfile;
use Carbon\CarbonImmutable;
use Throwable;

final class UserRepository implements UserRepositoryInterface
{
    /**
     * @param UserCredentialRepositoryInterface $userCredentialRepository
     * @param UserCredentialFactory $userCredentialFactory
     * @param UserProfileRepositoryInterface $userProfileRepository
     * @param UserProfileFactory $userProfileFactory
     * @param UserMailNotificationSettingRepositoryInterface $userMailNotificationSettingRepository
     * @param UserMailNotificationSettingFactory $userMailNotificationSettingFactory
     * @param UserImageRepositoryInterface $userImageRepository
     */
    public function __construct(
        private UserCredentialRepositoryInterface $userCredentialRepository,
        private UserCredentialFactory $userCredentialFactory,
        private UserProfileRepositoryInterface $userProfileRepository,
        private UserProfileFactory $userProfileFactory,
        private UserMailNotificationSettingRepositoryInterface $userMailNotificationSettingRepository,
        private UserMailNotificationSettingFactory $userMailNotificationSettingFactory,
        private UserImageRepositoryInterface $userImageRepository,
    ) {
    }

    /**
     * @inheritDoc
     */
    public function store(UserEntity $userEntity): int
    {
        $now = CarbonImmutable::now();

        $param = [
            'user_sub_id'        => $userEntity->getUserSubId()->value(),
            'name'               => $userEntity->getName()->value(),
            'birthday'           => $userEntity->getBirthday()->value(),
            'is_birthday_public' => $userEntity->getIsBirthdayPublic()->value(),
            'is_public'          => $userEntity->getIsPublic()->value(),
            'total_favorite'     => $userEntity->getTotalFavorite()->value(),
            'total_nice'         => $userEntity->getTotalNice()->value(),
        ];

        $userModel = User::updateOrCreate(
            ['id' => $userEntity->getId()],
            $param
        );

        // UserCredential の生成
        if (! is_null($userEntity->getUserCredential())) {
            $this->storeUserCredential(
                $userEntity->getUserCredential(),
                $userModel->id
            );
        }

        // UserProfile の生成
        if (! is_null($userEntity->getUserProfile())) {
            $this->storeUserProfile(
                $userEntity->getUserProfile(),
                $userModel->id
            );
        }

        // UserMailNotificationSetting を生成
        if (! is_null($userEntity->getUserMailNotificationSetting())) {
            $this->storeUserMailNotificationSetting(
                $userEntity->getUserMailNotificationSetting(),
                $userModel->id
            );
        }

        // UserImage の生成
        if (! is_null($userEntity->getUserImageList())) {
            $this->userImageRepository->deleteByUserId($userModel->id);
            $this->userImageRepository->bulkInsert($userEntity->getUserImageList(), $now);
        }

        return $userModel->id;
    }

    /**
     * @inheritDoc
     */
    public function findById(int $userId): UserEntity
    {
        try {
            $user = User::findOrFail($userId);
        } catch (Throwable $e) {
            $entityName = UserEntity::displayVariableName();

            throw new RecordsNotFoundException("指定された{$entityName}が見つかりませんでした。ID:{$userId}");
        }

        return $user->toEntity();
    }

    /**
     * @inheritDoc
     */
    public function findByIdWithRelations(
        int $userId,
        array $withRelations = [],
    ): UserEntity {
        try {
            $user = User::with($withRelations)->findOrFail($userId);
        } catch (Throwable $e) {
            $variableName = UserEntity::displayVariableName();

            throw new RecordsNotFoundException("指定された{$variableName}が見つかりません");
        }

        return $user->toEntity();
    }

    /**
     * UserCredentail を生成
     *
     * @param UserCredentialEntity $userCredentialEntity
     * @param int $userId
     * @return void
     */
    private function storeUserCredential(
        UserCredentialEntity $userCredentialEntity,
        int $userId
    ): void {
        $userCredentialEntity = $this->userCredentialFactory->reconstruct(
            $userCredentialEntity->getId(),
            $userId,
            $userCredentialEntity->getPlainPassword(),
            $userCredentialEntity->getEncryptedPassword(),
            $userCredentialEntity->getMailAddress(),
            $userCredentialEntity->getTwitterSubId(),
            $userCredentialEntity->getGoogleSubId(),
        );
        $this->userCredentialRepository->store($userCredentialEntity);
    }

    /**
     * UserProfile を生成
     *
     * @param UserProfileEntity $userProfileEntity
     * @param int $userId
     * @return void
     */
    private function storeUserProfile(
        UserProfileEntity $userProfileEntity,
        int $userId
    ): void {
        $userProfileEntity = $this->userProfileFactory->reconstruct(
            $userProfileEntity->getId(),
            $userId,
            $userProfileEntity->getCoverImagePath(),
            $userProfileEntity->getIconImagePath(),
            $userProfileEntity->getIntroduction(),
            $userProfileEntity->getIsPublicFollowlist(),
        );
        $this->userProfileRepository->store($userProfileEntity);
    }

    /**
     * UserMailNotificationSetting を生成
     *
     * @param UserMailNotificationSettingEntity $userMailNotificationSettingEntity
     * @param int $userId
     * @return void
     */
    private function storeUserMailNotificationSetting(
        UserMailNotificationSettingEntity $userMailNotificationSettingEntity,
        int $userId
    ): void {
        $userMailNotificationSettingEntity = $this->userMailNotificationSettingFactory->reconstruct(
            $userMailNotificationSettingEntity->getId(),
            $userId,
            $userMailNotificationSettingEntity->getFavoriteAndNice(),
            $userMailNotificationSettingEntity->getNewArrivalPost(),
            $userMailNotificationSettingEntity->getComment(),
            $userMailNotificationSettingEntity->getMessage(),
            $userMailNotificationSettingEntity->getBirthday(),
        );
        $this->userMailNotificationSettingRepository->store($userMailNotificationSettingEntity);
    }
}

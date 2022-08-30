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
    public function __construct(
    ) {
    }

    /**
     * @inheritDoc
     */
    public function store(UserEntity $userEntity): int
    {
        $param = [
            'name' => $userEntity->getName()->value(),
            'email' => $userEntity->getEmail()->value(),
            'email_verified_at' => $userEntity->getEmailVerifiedAt()->value(),
            'password' => $userEntity->getEncriptedPassword()->value(),
        ];

        $userModel = User::updateOrCreate(
            ['id' => $userEntity->getId()],
            $param
        );

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
            $entityName = UserEntity::NAME;

            throw new RecordsNotFoundException("指定された{$entityName}が見つかりませんでした。ID:{$userId}");
        }

        return $user->toEntity();
    }

    /**
     * @inheritDoc
     */
    public function findByIdRelations(
        int $userId,
        array $relations = [],
    ): UserEntity {
        try {
            $user = User::with($relations)->findOrFail($userId);
        } catch (Throwable $e) {
            $variableName = UserEntity::NAME;

            throw new RecordsNotFoundException("指定された{$variableName}が見つかりません");
        }

        return $user->toEntity();
    }

    /**
     * @inheritDoc
     */
    public function findByIdWhere(
        int $userId,
        array $where = [],
    ): UserEntity {
        try {
            $user = User::where($where)->findOrFail($userId);
        } catch (Throwable $e) {
            $variableName = UserEntity::NAME;

            throw new RecordsNotFoundException("指定された{$variableName}が見つかりません");
        }

        return $user->toEntity();
    }
}

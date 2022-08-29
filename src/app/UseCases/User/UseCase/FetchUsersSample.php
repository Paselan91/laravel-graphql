<?php

declare(strict_types=1);

namespace App\UseCases\User\UseCase;

use App\Domain\User\Entity\UserEntity;
use App\Domain\User\Factory\UserReconstructHelper;
use App\Domain\User\Repository\UserRepositoryInterface;
use App\Domain\UserProfile\Entity\UserProfileEntity;
use App\Domain\UserProfile\Factory\UserProfileReconstructHelper;
use App\Domain\UserProfile\Service\DeleteProfileImageService;
use App\Domain\UserProfile\Service\MoveProfileImageService;
use App\Exceptions\GraphQL\QueryException;
use App\Infrastructure\Models\User;
use App\UseCases\User\Dto\UserDto;
use Illuminate\Support\Facades\DB;
use Throwable;

final class FetchUsersSample
{
    /**
     * @param UserRepositoryInterface $userRepository
     * @param UserDto $userDto
     * @param MoveProfileImageService $moveProfileImageService
     * @param DeleteProfileImageService $deleteProfileImageService
     */
    public function __construct(
        private UserRepositoryInterface $userRepository,
        private UserDto $userDto,
        private MoveProfileImageService $moveProfileImageService,
        private DeleteProfileImageService $deleteProfileImageService,
    ) {
    }

    /**
     * @param array $args
     * @return User
     */
    public function execute(array $args): User
    {
        $oldUserEntity = $this->userRepository->findByIdWithRelations(
            (int) $args['user_id'],
            ['user_profile']
        );

        $userEntityForUpdate = $this->createReconstruct($oldUserEntity, $args);

        DB::beginTransaction();

        try {
            $userId = $this->userRepository->store($userEntityForUpdate);

            $newUserEntity = $this->userRepository->findByIdWithRelations(
                (int) $userId,
                ['user_profile']
            );

            $oldUserProfileEntity = $oldUserEntity->getUserProfile();
            $newUserProfileEntity = $newUserEntity->getUserProfile();
            if (is_null($oldUserProfileEntity) || is_null($newUserProfileEntity)) {
                $variableName = UserProfileEntity::displayVariableName();

                throw new QueryException(message: "{$variableName}エンティティがNULLです。");
            }

            // S3から古い画像を削除
            $this->deleteOldImages($oldUserProfileEntity);

            // 更新されたファイルを移動
            $this->moveImages($newUserProfileEntity, $args);

            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();

            throw $e;
        }

        return $this->userDto->toModel($newUserEntity);
    }

    /**
     * @param UserEntity $userEntity
     * @param array $args
     * @return UserEntity
     */
    private function createReconstruct(UserEntity $userEntity, array $args): UserEntity
    {
        $userProfileEntity = $this->reconstructUserProfileEntity($userEntity, $args);

        /** @var array<string, string|UserProfileEntity> */
        $reconstructArgs = [
            'name'         => $args['name'],
            'user_profile' => $userProfileEntity,
        ];

        /** @var string[] */
        $conversions = [
            'name',
            'user_profile'
        ];

        return UserReconstructHelper::reconstruct(
            $userEntity,
            $reconstructArgs,
            $conversions
        );
    }

    /**
     * @param UserEntity $userEntity
     * @param array $args
     * @return UserProfileEntity
     */
    private function reconstructUserProfileEntity(UserEntity $userEntity, array $args): UserProfileEntity
    {
        $userProfileEntity = $userEntity->getUserProfile();
        if (is_null($userProfileEntity)) {
            $variableName = UserProfileEntity::displayVariableName();

            throw new QueryException("{$variableName}がNULLです。");
        }

        $reconstructArgs = [
            'cover_image_path' => $args['cover_image_path'],
            'icon_image_path'  => $args['icon_image_path'],
            'introduction'     => $args['introduction'],
        ];

        $conversions = [
            'cover_image_path',
            'icon_image_path',
            'introduction'
        ];

        return UserProfileReconstructHelper::reconstruct($userProfileEntity, $reconstructArgs, $conversions);
    }

    /**
     * S3から古い画像を削除
     *
     * @param UserProfileEntity $userProfileEntity
     * @return void
     */
    private function deleteOldImages(UserProfileEntity $userProfileEntity): void
    {
        $hasImages = $userProfileEntity->getCoverImagePath() || $userProfileEntity->getIconImagePath();
        if (! $hasImages) {
            return;
        }

        // 既存ファイル削除
        $this->deleteProfileImageService->deleteAll($userProfileEntity);
    }

    /**
     * ファイル移動処理
     *
     * @param UserProfileEntity $userProfileEntity
     * @param array $args
     * @return void
     */
    private function moveImages(UserProfileEntity $userProfileEntity, array $args): void
    {
        /** @var string[] 移動対象のkey */
        $moveImageKeys = [];
        if (isset($args['cover_image_path'])) {
            $moveImageKeys[] = 'cover_image_path';
        }
        if (isset($args['icon_image_path'])) {
            $moveImageKeys[] = 'icon_image_path';
        }

        if (empty($moveImageKeys)) {
            return;
        }

        $this->moveProfileImageService->moveImages(
            $userProfileEntity,
            $moveImageKeys
        );
    }
}

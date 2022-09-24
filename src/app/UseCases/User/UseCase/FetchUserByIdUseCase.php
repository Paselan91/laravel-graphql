<?php

declare(strict_types=1);

namespace App\UseCases\User\UseCase;

use App\Domain\User\Repository\UserRepositoryInterface;
use App\GraphQL\User\Query\Inputs\FetchUserByIdInput;
use App\Infrastructure\Models\User;
use App\UseCases\User\Dto\UserDto;

final class FetchUserByIdUseCase
{
    /**
     * @param UserRepositoryInterface $userRepository
     * @param UserDto                 $userDto
     */
    public function __construct(
        private UserRepositoryInterface $userRepository,
        private UserDto $userDto,
    ) {
    }

    /**
     * @param  FetchUserByIdInput $input
     * @return User
     */
    public function execute(FetchUserByIdInput $input): User
    {
        $userEntity = $this->userRepository->findById($input->getId());

        return $this->userDto->toModel($userEntity);
    }
}

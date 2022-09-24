<?php

declare(strict_types=1);

namespace App\GraphQL\User\Query;

use App\GraphQL\User\Query\Inputs\FetchUserByIdInput;
use App\Infrastructure\Models\User;
use App\UseCases\User\UseCase\FetchUserByIdUseCase;

final class FetchUserByIdQuery
{
    /**
     * @param FetchUserByIdUseCase $fetchUserByIdUseCase
     */
    public function __construct(
        private FetchUserByIdUseCase $fetchUserByIdUseCase
    ) {
    }

    /**
     * @param null $_
     * @param  array{}  $args
     * @return User
     */
    public function __invoke($_, array $args): User
    {
        $input = FetchUserByIdInput::build($args);

        return $this->fetchUserByIdUseCase->execute($input);
    }
}

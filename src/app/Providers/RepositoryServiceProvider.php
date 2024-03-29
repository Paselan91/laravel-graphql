<?php

declare(strict_types=1);

namespace App\Providers;

use App\Domain\User\Repository\UserRepositoryInterface;
use App\Infrastructure\Repositories\User\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $bindData = [
            UserRepositoryInterface::class => UserRepository::class
        ];

        foreach ($bindData as $repositoryInterface => $repository) {
            $this->app->bind($repositoryInterface, $repository);
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

<?php

declare(strict_types=1);

namespace App\Providers;

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

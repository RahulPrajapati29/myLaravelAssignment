<?php

namespace App\Providers;

use App\Repositories\ImplementRepository\PostRepository;
use App\Repositories\PostRepositoryInterface;
use App\Repositories\ImplementRepository\UserRepository;
use App\Repositories\UserRepositoryInterface;
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
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(UserRepositoryInterface::class,UserRepository::class);
        $this->app->bind(PostRepositoryInterface::class,PostRepository::class);

    }
}

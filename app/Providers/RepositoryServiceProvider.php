<?php

namespace App\Providers;

use App\Repositories\Base\BaseRepository;
use App\Repositories\BaseContracts\ContactRepositoryInterface;
use App\Repositories\BaseContracts\RepositoryInterface;
use App\Repositories\BaseContracts\UserRepositoryInterface;
use App\Repositories\ContactRepository;
use App\Repositories\UserRepository;
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
        $this->app->bind(RepositoryInterface::class, BaseRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(ContactRepositoryInterface::class, ContactRepository::class);
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

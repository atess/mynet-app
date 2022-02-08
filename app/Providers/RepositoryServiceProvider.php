<?php

namespace App\Providers;

use App\Contracts\Repositories\AddressRepositoryInterface;
use App\Contracts\Repositories\BaseRepositoryInterface;
use App\Contracts\Repositories\PersonRepositoryInterface;
use App\Repositories\AddressRepository;
use App\Repositories\BaseRepository;
use App\Repositories\PersonRepository;
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
        $this->app->bind(BaseRepositoryInterface::class, BaseRepository::class);
        $this->app->bind(AddressRepositoryInterface::class, AddressRepository::class);
        $this->app->bind(PersonRepositoryInterface::class, PersonRepository::class);
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

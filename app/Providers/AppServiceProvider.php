<?php

namespace App\Providers;

use App\Models\Address;
use App\Models\Person;
use App\Observers\AddressObserver;
use App\Observers\PersonObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Person::observe(PersonObserver::class);
        Address::observe(AddressObserver::class);
    }
}

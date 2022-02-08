<?php

namespace App\Observers;

use App\Models\Address;
use Illuminate\Support\Facades\Artisan;

class AddressObserver
{
    /**
     * Handle the Address "created" event.
     *
     * @param Address $address
     * @return void
     */
    public function created(Address $address)
    {
        Artisan::call('cache:clear');
    }

    /**
     * Handle the Address "updated" event.
     *
     * @param Address $address
     * @return void
     */
    public function updated(Address $address)
    {
        Artisan::call('cache:clear');
    }

    /**
     * Handle the Address "deleted" event.
     *
     * @param Address $address
     * @return void
     */
    public function deleted(Address $address)
    {
        Artisan::call('cache:clear');
    }
}

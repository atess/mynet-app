<?php

namespace App\Observers;

use App\Models\Person;
use Illuminate\Support\Facades\Artisan;

class PersonObserver
{
    /**
     * Handle the Person "created" event.
     *
     * @param Person $person
     * @return void
     */
    public function created(Person $person)
    {
        Artisan::call('cache:clear');
    }

    /**
     * Handle the Person "updated" event.
     *
     * @param Person $person
     * @return void
     */
    public function updated(Person $person)
    {
        Artisan::call('cache:clear');
    }

    /**
     * Handle the Person "deleted" event.
     *
     * @param Person $person
     * @return void
     */
    public function deleted(Person $person)
    {
        Artisan::call('cache:clear');
    }
}

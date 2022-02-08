<?php

namespace App\Repositories;

use App\Contracts\Repositories\PersonRepositoryInterface;
use App\Models\Person;

class PersonRepository extends BaseRepository implements PersonRepositoryInterface
{
    /**
     * Class Constructor
     * @param Person $person
     */
    public function __construct(Person $person)
    {
        parent::__construct($person);
    }
}

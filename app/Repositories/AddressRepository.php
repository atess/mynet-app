<?php

namespace App\Repositories;

use App\Contracts\Repositories\AddressRepositoryInterface;
use App\Models\Address;

class AddressRepository extends BaseRepository implements AddressRepositoryInterface
{
    /**
     * Class Constructor
     * @param Address $address
     */
    public function __construct(Address $address)
    {
        parent::__construct($address);
    }
}

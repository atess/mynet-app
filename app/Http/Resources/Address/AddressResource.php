<?php

namespace App\Http\Resources\Address;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property int $id
 * @property string $address
 * @property string $post_code
 * @property string $city_name
 * @property string $country_name
 * @property int $person_id
 */
class AddressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'address' => $this->address,
            'post_code' => $this->post_code,
            'city_name' => $this->city_name,
            'country_name' => $this->country_name,
            'person_id' => $this->person_id,
        ];
    }
}

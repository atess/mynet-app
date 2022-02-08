<?php

namespace Database\Factories;

use App\Models\Address;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Address::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'address' => $this->faker->address,
            'post_code' => (string)$this->faker->numberBetween(10000, 99999),
            'city_name' => $this->faker->city,
            'country_name' => $this->faker->country,
        ];
    }
}

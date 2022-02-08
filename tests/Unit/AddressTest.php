<?php

namespace Tests\Unit;

use App\Models\Address;
use App\Models\Person;
use Tests\TestCase;

class AddressTest extends TestCase
{
    /**
     * Bir kisi olusturulur bu kisiye adres ekleme endpointi kontrol edilir.
     *
     * @return void
     */
    public function test_adres_ekle()
    {
        $person = Person::factory()
            ->create();

        $address = $this->faker->address;

        $this->postJson(route('address.store'), [
            'person_id' => $person->id,
            'address' => $address,
            'post_code' => (string)$this->faker->numberBetween(10000, 99999),
            'city_name' => $this->faker->city,
            'country_name' => $this->faker->country,
        ])
            ->assertStatus(201)
            ->assertJsonStructure([
                'status',
                'message',
                'data' => [
                    'id',
                    'person_id',
                    'address',
                    'post_code',
                    'city_name',
                    'country_name',
                ],
            ]);

        $this->assertDatabaseHas('addresses', [
            'address' => $address,
            'person_id' => $person->id,
        ]);
    }

    /**
     * Bir kisi olusturulur bu kisiye adres eklenir
     * ve adres guncelleme endpointi kontrol edilir.
     *
     * @return void
     */
    public function test_adres_guncelle()
    {
        $newAddress = $this->faker->address;
        $newPostCode = (string)$this->faker->numberBetween(10000, 99999);
        $newCityName = $this->faker->city;
        $newCountryName = $this->faker->country;

        $person = Person::factory()
            ->has(
                Address::factory()
                    ->count(1)
                    ->state(function (array $attributes, Person $person) {
                        return [
                            'person_id' => $person->id,
                        ];
                    })
            )
            ->create();

        $this->putJson(route('address.update', ['address' => 1]), [
            'address' => $newAddress,
            'post_code' => $newPostCode,
            'city_name' => $newCityName,
            'country_name' => $newCountryName,
        ])
            ->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
                'data' => [
                    'id',
                    'person_id',
                    'address',
                    'post_code',
                    'city_name',
                    'country_name',
                ],
            ]);

        $this->assertDatabaseHas('addresses', [
            'address' => $newAddress,
            'person_id' => $person->id,
            'post_code' => $newPostCode,
            'city_name' => $newCityName,
            'country_name' => $newCountryName,
        ]);
    }


    /**
     * Bir kisi olusturulur bu kisiye bir adres eklenir
     * ve adres silme endpointi kontrol edilir.
     *
     * @return void
     */
    public function test_adres_sil()
    {
        Person::factory()
            ->has(
                Address::factory()
                    ->count(1)
                    ->state(function (array $attributes, Person $person) {
                        return [
                            'person_id' => $person->id,
                        ];
                    })
            )
            ->create();

        $this->deleteJson(route('address.destroy', ['address' => 1]))
            ->assertStatus(200);

        $this->assertDatabaseCount('addresses', 0);
    }

    /**
     * Bir kisi olusturulur bu kisiye 20 adet adres eklenir
     * ve adres listesi endpointinin dondugu sonuclar kontrol edilir.
     *
     * @return void
     */
    public function test_adres_listesi()
    {
        $person = Person::factory()
            ->has(
                Address::factory()
                    ->count(20)
                    ->state(function (array $attributes, Person $person) {
                        return ['person_id' => $person->id];
                    })
            )
            ->create();

        $url = route('address.index') . '?' . http_build_query(['person_id' => $person->id]);

        $this->getJson($url)
            ->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
                'data' => [
                    'list' => [
                        '*' => [
                            'id',
                            'address',
                            'post_code',
                            'city_name',
                            'country_name',
                            'person_id',
                        ]
                    ],
                    'pagination' => [
                        'total',
                        'count',
                        'per_page',
                        'current_page',
                        'total_pages',
                    ]
                ]
            ]);
    }
}

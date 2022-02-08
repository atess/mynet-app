<?php

namespace Tests\Unit;

use App\Models\Address;
use App\Models\Person;
use Tests\TestCase;

class PersonTest extends TestCase
{
    /**
     * Bir kisi olusturulur bu kisiye adres ekleme endpointi kontrol edilir.
     *
     * @return void
     */
    public function test_kisi_ekle()
    {
        $name = $this->faker->name;
        $birthday = $this->faker->date();
        $gender = $this->faker->randomElement(['male', 'female']);

        $this->postJson(route('person.store'), [
            'name' => $name,
            'birthday' => $birthday,
            'gender' => $gender,
        ])
            ->assertStatus(201)
            ->assertJsonStructure([
                'status',
                'message',
                'data' => [
                    'id',
                    'name',
                    'birthday',
                    'gender',
                ],
            ]);

        $this->assertDatabaseHas('people', [
            'name' => $name,
            'birthday' => $birthday,
            'gender' => $gender,
        ]);
    }

    /**
     * Bir kisi olusturulur bu kisiye adres eklenir ve adres guncelleme endpointi kontrol edilir.
     *
     * @return void
     */
    public function test_kisi_guncelle()
    {
        $name = $this->faker->name;
        $birthday = $this->faker->date();
        $gender = $this->faker->randomElement(['male', 'female']);

        Person::factory()->create();

        $this->putJson(route('person.update', ['person' => 1]), [
            'name' => $name,
            'birthday' => $birthday,
            'gender' => $gender,
        ])
            ->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
                'data' => [
                    'id',
                    'name',
                    'birthday',
                    'gender',
                ],
            ]);

        $this->assertDatabaseHas('people', [
            'name' => $name,
            'birthday' => $birthday,
            'gender' => $gender,
        ]);
    }


    /**
     * Bir kisi olusturulur bu kisiye adres ekleme endpointi kontrol edilir.
     *
     * @return void
     */
    public function test_kisi_sil()
    {
        Person::factory()->create();

        $this->deleteJson(route('person.destroy', ['person' => 1]))
            ->assertStatus(200);

        $this->assertDatabaseCount('people', 0);
    }

    /**
     * Bir kisi olusturulur bu kisiye 20 adet adres eklenir
     * ve adres listesi endpointinin dondugu sonuclar kontrol edilir.
     *
     * @return void
     */
    public function test_kisi_listesi()
    {
        Person::factory()
            ->count(20)
            ->create();

        $this->getJson(route('person.index'))
            ->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
                'data' => [
                    'list' => [
                        '*' => [
                            'id',
                            'name',
                            'birthday',
                            'gender',
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

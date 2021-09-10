<?php

namespace Database\Seeders;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        User::factory()
                ->count(20)
                ->state(function (array $attributes) use ($faker) {
                    return ['unique_name' => $attributes['first_name'] . '_' . $faker->unique()->numberBetween(1, 999)];
                })
                ->has(Contact::factory()
                    ->count(4)
                    ->state(function (array $attributes, User $user) {
                        return ['user_id' => $user->id];
                    }))
                ->create();
    }
}

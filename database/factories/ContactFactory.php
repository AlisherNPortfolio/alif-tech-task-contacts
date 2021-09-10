<?php

namespace Database\Factories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Contact::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $type = rand(1,2);
        return [
            'type' => $type,
            'contact' => $type === 1 ? $this->faker->phoneNumber() : $this->faker->email()
        ];
    }

    public function suspended()
    {
        return $this->state(function (array $attributes) {
            return [
                'user_id' => 'suspended'
            ];
        });
    }
}

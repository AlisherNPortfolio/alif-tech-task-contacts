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
        $arrayTypes = ['PHONE', 'EMAIL'];

        $typeIndex = array_rand($arrayTypes, 1);
        return [
            'type' => $arrayTypes[$typeIndex],
            'contact' => $arrayTypes[$typeIndex] === 'PHONE' ? $this->faker->phoneNumber() : $this->faker->email()
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

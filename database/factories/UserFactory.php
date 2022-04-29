<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'gender' => $gender = $this->faker->randomElement(User::GENDER),
            'name' => $this->faker->name($gender),
            'email' => $this->faker->unique()->safeEmail,
            'mobile' => $this->faker->unique()->numerify('09#########'),
            'password' => Hash::make("123456"),
        ];
    }
}

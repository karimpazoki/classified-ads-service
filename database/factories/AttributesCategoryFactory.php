<?php

namespace Database\Factories;

use App\Models\AttributesCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class AttributesCategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AttributesCategory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->text('25'),
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Property;
use Illuminate\Database\Eloquent\Factories\Factory;

class PropertyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Property::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->words(2, true),
            'price' => $this->faker->numberBetween(100000, 1000000),
            'bedrooms' => $this->faker->numberBetween(1, 5),
            'bathrooms' => $this->faker->numberBetween(1, 3),
            'storeys' => $this->faker->numberBetween(1, 3),
            'garages' => $this->faker->numberBetween(0, 3),
        ];
    }
}

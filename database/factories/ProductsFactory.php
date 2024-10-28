<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Products>
 */
class ProductsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this ->faker->name,
            'marca' => $this ->faker->company,
            'precio' => $this->faker->randomFloat(2, 1, 1000),
            'departament_id' => $this ->faker->numberBetween(1,6)
        ];
    }
}

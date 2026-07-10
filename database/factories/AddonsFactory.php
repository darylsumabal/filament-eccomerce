<?php

namespace Database\Factories;

use App\Models\Addons;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Addons>
 */
class AddonsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'price' => fake()->randomFloat(2, 1, 100),
        ];
    }
}

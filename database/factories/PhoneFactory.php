<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Phone>
 */
class PhoneFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'phone' => fake()->unique()->numerify('55##9########'),
            'monthly_price' => fake()->randomFloat(2, 1, 200),
            'setup_price' => fake()->randomFloat(2, 1, 400),
            'currency' => "BRL",
        ];
    }
}

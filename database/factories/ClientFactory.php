<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->company(),
            'logo_path' => 'clients/mock_logo_' . fake()->numberBetween(1, 10) . '.png',
            'website' => fake()->url(),
        ];
    }
}

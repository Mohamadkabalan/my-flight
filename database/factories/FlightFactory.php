<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FlightFactory extends Factory
{
    public function definition(): array
    {
        return [
            'status' => $this->faker->randomElement(['draft', 'confirmed', 'cancelled', 'completed']),
        ];
    }

    public function draft(): static
    {
        return $this->state(['status' => 'draft']);
    }

    public function confirmed(): static
    {
        return $this->state(['status' => 'confirmed']);
    }
}

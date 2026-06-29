<?php

namespace Database\Factories;

use App\Models\Flight;
use Illuminate\Database\Eloquent\Factories\Factory;

class LegFactory extends Factory
{
    public function definition(): array
    {
        return [
            'flight_id' => Flight::factory(),
            'position' => 1,
        ];
    }
}

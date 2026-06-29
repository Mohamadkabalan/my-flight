<?php

namespace Database\Factories;

use App\Models\Leg;
use Illuminate\Database\Eloquent\Factories\Factory;

class SegmentFactory extends Factory
{
    public function definition(): array
    {
        $departure = $this->faker->dateTimeBetween('+1 week', '+3 months');
        $arrival = (clone $departure)->modify(sprintf('+%d hours +%d minutes', rand(1, 13), rand(0, 59)));

        return [
            'leg_id' => Leg::factory(),
            'position' => 1,
            'origin' => strtoupper($this->faker->lexify('???')),
            'destination' => strtoupper($this->faker->lexify('???')),
            'departure_at' => $departure,
            'arrival_at' => $arrival,
            'cabin_class' => $this->faker->randomElement(['economy', 'premium_economy', 'business', 'first']),
            'airline' => strtoupper($this->faker->lexify('??')),
            'flight_number' => strtoupper($this->faker->bothify('??###')),
        ];
    }
}

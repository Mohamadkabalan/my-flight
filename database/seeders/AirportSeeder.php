<?php

namespace Database\Seeders;

use App\Models\Airport;
use Illuminate\Database\Seeder;

class AirportSeeder extends Seeder
{
    public function run(): void
    {
        Airport::upsert([
            ['iata_code' => 'JFK', 'name' => 'John F. Kennedy International', 'city' => 'New York',      'country' => 'US'],
            ['iata_code' => 'LHR', 'name' => 'London Heathrow',               'city' => 'London',        'country' => 'GB'],
            ['iata_code' => 'BCN', 'name' => 'Barcelona El Prat',             'city' => 'Barcelona',     'country' => 'ES'],
            ['iata_code' => 'CDG', 'name' => 'Charles de Gaulle',             'city' => 'Paris',         'country' => 'FR'],
            ['iata_code' => 'DXB', 'name' => 'Dubai International',           'city' => 'Dubai',         'country' => 'AE'],
            ['iata_code' => 'SIN', 'name' => 'Singapore Changi',              'city' => 'Singapore',     'country' => 'SG'],
            ['iata_code' => 'NRT', 'name' => 'Narita International',          'city' => 'Tokyo',         'country' => 'JP'],
            ['iata_code' => 'LAX', 'name' => 'Los Angeles International',     'city' => 'Los Angeles',   'country' => 'US'],
            ['iata_code' => 'FRA', 'name' => 'Frankfurt Airport',             'city' => 'Frankfurt',     'country' => 'DE'],
            ['iata_code' => 'AMS', 'name' => 'Amsterdam Schiphol',            'city' => 'Amsterdam',     'country' => 'NL'],
        ], ['iata_code'], ['name', 'city', 'country']);
    }
}

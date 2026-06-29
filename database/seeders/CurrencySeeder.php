<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    public function run(): void
    {
        Currency::upsert([
            ['code' => 'USD', 'name' => 'US Dollar',         'symbol' => '$',   'decimal_places' => 2],
            ['code' => 'EUR', 'name' => 'Euro',               'symbol' => '€',   'decimal_places' => 2],
            ['code' => 'GBP', 'name' => 'British Pound',      'symbol' => '£',   'decimal_places' => 2],
            ['code' => 'JPY', 'name' => 'Japanese Yen',       'symbol' => '¥',   'decimal_places' => 0],
            ['code' => 'CHF', 'name' => 'Swiss Franc',        'symbol' => 'Fr',  'decimal_places' => 2],
            ['code' => 'CAD', 'name' => 'Canadian Dollar',    'symbol' => '$',   'decimal_places' => 2],
            ['code' => 'AUD', 'name' => 'Australian Dollar',  'symbol' => '$',   'decimal_places' => 2],
            ['code' => 'CNY', 'name' => 'Chinese Yuan',       'symbol' => '¥',   'decimal_places' => 2],
            ['code' => 'AED', 'name' => 'UAE Dirham',         'symbol' => 'د.إ', 'decimal_places' => 2],
            ['code' => 'SGD', 'name' => 'Singapore Dollar',   'symbol' => '$',   'decimal_places' => 2],
        ], ['code'], ['name', 'symbol', 'decimal_places']);
    }
}

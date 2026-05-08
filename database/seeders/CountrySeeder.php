<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    public function run(): void
    {
        Country::firstOrCreate(
            ['country_name' => 'United States'],
            [
                'iso_code' => 'US',
                'currency' => 'USD',
                'world_region' => 'North America',
            ]
        );
    }
}

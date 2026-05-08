<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            CountrySeeder::class,
            StateSeeder::class,
            EntityTypeSeeder::class,
            IndustrySeeder::class,
            BlogCategorySeeder::class,
            BlogTagSeeder::class,
            PageSeeder::class,
        ]);
    }
}

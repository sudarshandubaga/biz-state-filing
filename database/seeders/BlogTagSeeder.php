<?php

namespace Database\Seeders;

use App\Models\BlogTag;
use Illuminate\Database\Seeder;

class BlogTagSeeder extends Seeder
{
    public function run(): void
    {
        $tags = [
            ['name' => 'LLC', 'slug' => 'llc'],
            ['name' => 'Corporation', 'slug' => 'corporation'],
            ['name' => 'Annual Report', 'slug' => 'annual-report'],
            ['name' => 'Filing Deadline', 'slug' => 'filing-deadline'],
            ['name' => 'Business License', 'slug' => 'business-license'],
            ['name' => 'Registered Agent', 'slug' => 'registered-agent'],
            ['name' => 'Tax Deductions', 'slug' => 'tax-deductions'],
            ['name' => 'S Corporation', 'slug' => 's-corporation'],
            ['name' => 'Nonprofit', 'slug' => 'nonprofit'],
            ['name' => 'DBA', 'slug' => 'dba'],
            ['name' => 'Compliance', 'slug' => 'compliance'],
            ['name' => 'Startup', 'slug' => 'startup'],
            ['name' => 'Small Business', 'slug' => 'small-business'],
            ['name' => 'EIN', 'slug' => 'ein'],
            ['name' => 'Franchise Tax', 'slug' => 'franchise-tax'],
        ];

        foreach ($tags as $tag) {
            BlogTag::firstOrCreate(
                ['slug' => $tag['slug']],
                $tag
            );
        }
    }
}

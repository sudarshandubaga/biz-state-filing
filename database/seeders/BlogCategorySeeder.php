<?php

namespace Database\Seeders;

use App\Models\BlogCategory;
use Illuminate\Database\Seeder;

class BlogCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'LLC Formation', 'slug' => 'llc-formation', 'description' => 'Articles about forming and managing Limited Liability Companies.', 'status' => 1],
            ['name' => 'Business Compliance', 'slug' => 'business-compliance', 'description' => 'Annual compliance requirements, deadlines, and filing tips.', 'status' => 1],
            ['name' => 'State Filing Deadlines', 'slug' => 'state-filing-deadlines', 'description' => 'State-specific filing deadlines and requirements.', 'status' => 1],
            ['name' => 'Business Licenses', 'slug' => 'business-licenses', 'description' => 'Licensing requirements by industry and location.', 'status' => 1],
            ['name' => 'Tax Tips', 'slug' => 'tax-tips', 'description' => 'Business tax tips, deductions, and filing guidance.', 'status' => 1],
            ['name' => 'Startup Advice', 'slug' => 'startup-advice', 'description' => 'Tips and guidance for starting a new business.', 'status' => 1],
            ['name' => 'Industry Guides', 'slug' => 'industry-guides', 'description' => 'In-depth guides for specific industries.', 'status' => 1],
            ['name' => 'Registered Agent', 'slug' => 'registered-agent', 'description' => 'Information about registered agent requirements.', 'status' => 1],
        ];

        foreach ($categories as $category) {
            BlogCategory::firstOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }
}

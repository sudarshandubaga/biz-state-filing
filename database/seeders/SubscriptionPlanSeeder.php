<?php

namespace Database\Seeders;

use App\Models\SubscriptionPlan;
use Illuminate\Database\Seeder;

class SubscriptionPlanSeeder extends Seeder
{
    public function run(): void
    {
        SubscriptionPlan::create([
            'name' => 'Free Plan',
            'slug' => 'free',
            'description' => 'Get started with basic business formation tools and resources.',
            'features' => ['basic_forms', 'resources', 'limited_calendar'],
            'price_monthly' => 0,
            'price_yearly' => 0,
            'sort_order' => 1,
            'is_popular' => false,
            'status' => true,
        ]);

        SubscriptionPlan::create([
            'name' => 'Pro Plan',
            'slug' => 'pro',
            'description' => 'Unlock full compliance calendar, EIN assistance, and more.',
            'features' => [
                'basic_forms',
                'resources',
                'limited_calendar',
                'full_calendar',
                'annual_report_reminders',
                'ein_assistance',
                'ra_discount',
            ],
            'price_monthly' => 29.99,
            'price_yearly' => 299.99,
            'sort_order' => 2,
            'is_popular' => true,
            'status' => true,
        ]);

        SubscriptionPlan::create([
            'name' => 'Business Compliance Plan',
            'slug' => 'compliance',
            'description' => 'Everything in Pro plus compliance monitoring, multi-state reminders, and auto-filled forms.',
            'features' => [
                'basic_forms',
                'resources',
                'limited_calendar',
                'full_calendar',
                'annual_report_reminders',
                'ein_assistance',
                'ra_discount',
                'compliance_monitoring',
                'multi_state_reminders',
                'auto_filled_forms',
            ],
            'price_monthly' => 59.99,
            'price_yearly' => 599.99,
            'sort_order' => 3,
            'is_popular' => false,
            'status' => true,
        ]);
    }
}

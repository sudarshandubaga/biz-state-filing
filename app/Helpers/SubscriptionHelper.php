<?php

namespace App\Helpers;

use App\Models\SubscriptionPlan;
use App\Models\UserSubscription;

class SubscriptionHelper
{
    /**
     * All available feature keys in the system.
     */
    const FEATURES = [
        'basic_forms' => 'Basic Tax Forms',
        'resources' => 'Resources & Guides',
        'limited_calendar' => 'Limited Compliance Calendar',
        'full_calendar' => 'Full Compliance Calendar',
        'annual_report_reminders' => 'Annual Report Reminders',
        'ein_assistance' => 'EIN Assistance',
        'ra_discount' => 'Registered Agent Discount',
        'compliance_monitoring' => 'Compliance Monitoring',
        'multi_state_reminders' => 'Multi-State Reminders',
        'auto_filled_forms' => 'Auto-Filled Forms',
    ];

    /**
     * Get the user's active subscription.
     */
    public static function getUserSubscription($userId): ?UserSubscription
    {
        return UserSubscription::where('user_id', $userId)
            ->where('status', 'active')
            ->where(function ($q) {
                $q->whereNull('expires_at')
                  ->orWhere('expires_at', '>', now());
            })
            ->with('plan')
            ->latest()
            ->first();
    }

    /**
     * Check if user has access to a specific feature.
     */
    public static function userHasFeature($userId, string $featureKey): bool
    {
        $subscription = self::getUserSubscription($userId);
        return $subscription && $subscription->hasFeature($featureKey);
    }

    /**
     * Get the plan slug for a user (free/pro/compliance).
     */
    public static function getUserPlanSlug($userId): string
    {
        $subscription = self::getUserSubscription($userId);
        return $subscription ? $subscription->plan->slug : 'free';
    }

    /**
     * Get the next tier plan info for upgrade modal.
     * Returns [plan, features_to_unlock]
     */
    public static function getUpgradeInfo(string $currentPlanSlug): array
    {
        $tiers = ['free' => 'pro', 'pro' => 'compliance'];
        $nextSlug = $tiers[$currentPlanSlug] ?? null;

        if (!$nextSlug) {
            return [null, []];
        }

        $nextPlan = SubscriptionPlan::where('slug', $nextSlug)->first();
        if (!$nextPlan) {
            return [null, []];
        }

        $currentFeatures = [];
        $currentPlan = SubscriptionPlan::where('slug', $currentPlanSlug)->first();
        if ($currentPlan) {
            $currentFeatures = $currentPlan->features ?? [];
        }

        $lockedFeatures = array_diff($nextPlan->features ?? [], $currentFeatures);
        $featureLabels = array_intersect_key(self::FEATURES, array_flip($lockedFeatures));

        return [$nextPlan, $featureLabels];
    }
}
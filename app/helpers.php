<?php

use App\Helpers\SubscriptionHelper;
use App\Models\Setting;

if (!function_exists('getSetting')) {
    function getSetting($key, $default = null)
    {
        return Setting::getValue($key, $default);
    }
}

if (!function_exists('userHasFeature')) {
    function userHasFeature($userId, string $featureKey): bool
    {
        return SubscriptionHelper::userHasFeature($userId, $featureKey);
    }
}

if (!function_exists('getUserPlanSlug')) {
    function getUserPlanSlug($userId): string
    {
        return SubscriptionHelper::getUserPlanSlug($userId);
    }
}

if (!function_exists('getFeatureLabel')) {
    function getFeatureLabel(string $featureKey): string
    {
        return SubscriptionHelper::FEATURES[$featureKey] ?? $featureKey;
    }
}

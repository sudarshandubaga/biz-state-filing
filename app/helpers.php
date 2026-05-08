<?php

use App\Models\Setting;

if (!function_exists('getSetting')) {
    function getSetting($key, $default = null)
    {
        $setting = cache()->remember('site_settings', 3600, function () {
            return Setting::first();
        });

        return $setting ? ($setting->$key ?? $default) : $default;
    }
}

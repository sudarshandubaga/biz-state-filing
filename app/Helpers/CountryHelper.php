<?php

namespace App\Helpers;

use App\Models\Country;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class CountryHelper
{
    /**
     * Detect user's country by IP address.
     * Falls back to US if detection fails.
     */
    public static function detectByIP($ip = null)
    {
        $ip = $ip ?? request()->ip();

        // Skip private/local IPs
        if ($ip === '127.0.0.1' || $ip === '::1' || str_starts_with($ip, '192.168.') || str_starts_with($ip, '10.0.')) {
            return self::getDefaultCountry();
        }

        $cacheKey = 'country_ip_' . md5($ip);

        return Cache::remember($cacheKey, now()->addDays(7), function () use ($ip) {
            try {
                // Try ipapi.co first (free, no key needed for basic lookups)
                $response = Http::timeout(5)->get("http://ip-api.com/json/{$ip}?fields=countryCode");
                
                if ($response->successful()) {
                    $data = $response->json();
                    $countryCode = strtolower($data['countryCode'] ?? '');
                    
                    if ($countryCode) {
                        $country = Country::where('short_name', $countryCode)->first();
                        if ($country) {
                            return $country;
                        }
                    }
                }
            } catch (\Exception $e) {
                // Fallback to default
            }

            return self::getDefaultCountry();
        });
    }

    /**
     * Get the default country (first active country or US)
     */
    public static function getDefaultCountry()
    {
        return Country::where('short_name', 'US')
            ->orWhere('status', true)
            ->orderBy('id')
            ->first();
    }

    /**
     * Get user's selected country from session, or detect by IP
     */
    public static function getSelectedCountry()
    {
        if (session()->has('selected_country_id')) {
            $country = Country::find(session('selected_country_id'));
            if ($country) {
                return $country;
            }
        }

        return self::detectByIP();
    }

    /**
     * Set the selected country in session
     */
    public static function setSelectedCountry($countryId)
    {
        session(['selected_country_id' => $countryId]);
    }
}
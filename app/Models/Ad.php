<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    protected $guarded = [];

    protected $casts = [
        'states_targeting' => 'array',
        'naics_targeting' => 'array',
        'status' => 'boolean',
        'start_date' => 'date',
        'end_date' => 'date',
        'max_impressions' => 'integer',
        'max_clicks' => 'integer',
        'current_impressions' => 'integer',
        'current_clicks' => 'integer',
        'weight' => 'integer',
    ];

    public function affiliate()
    {
        return $this->belongsTo(Affiliate::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', true)
            ->where(function ($q) {
                $q->whereNull('start_date')->orWhere('start_date', '<=', now());
            })
            ->where(function ($q) {
                $q->whereNull('end_date')->orWhere('end_date', '>=', now());
            })
            ->where(function ($q) {
                $q->whereNull('max_impressions')->orWhereColumn('current_impressions', '<', 'max_impressions');
            })
            ->where(function ($q) {
                $q->whereNull('max_clicks')->orWhereColumn('current_clicks', '<', 'max_clicks');
            });
    }

    public function scopeByPlacement($query, $placement)
    {
        return $query->where('placement', $placement);
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function scopeByState($query, $stateCode)
    {
        return $query->where(function ($q) use ($stateCode) {
            $q->whereNull('states_targeting')
                ->orWhere('states_targeting', '[]')
                ->orWhereJsonContains('states_targeting', $stateCode);
        });
    }

    public function scopeByDevice($query, $device)
    {
        if ($device === 'all') return $query;
        return $query->whereIn('device_targeting', [$device, 'all']);
    }

    public function scopeWeighted($query)
    {
        return $query->inRandomOrder()->orderBy('weight', 'desc');
    }

    public function isActive()
    {
        if (!$this->status) return false;
        if ($this->start_date && now()->lt($this->start_date)) return false;
        if ($this->end_date && now()->gt($this->end_date)) return false;
        if ($this->max_impressions && $this->current_impressions >= $this->max_impressions) return false;
        if ($this->max_clicks && $this->current_clicks >= $this->max_clicks) return false;
        return true;
    }

    public function getUrlAttribute()
    {
        $url = $this->target_url;
        $params = [];
        if ($this->utm_source) $params['utm_source'] = $this->utm_source;
        if ($this->utm_medium) $params['utm_medium'] = $this->utm_medium;
        if ($this->utm_campaign) $params['utm_campaign'] = $this->utm_campaign;
        if (!empty($params)) {
            $separator = str_contains($url, '?') ? '&' : '?';
            $url .= $separator . http_build_query($params);
        }
        return $url;
    }
}

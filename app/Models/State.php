<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class State extends Model
{
    protected $guarded = [];

    protected $casts = [
        'filing_fee' => 'decimal:2',
        'late_fee' => 'decimal:2',
        'annual_llc_fee' => 'decimal:2',
        'report_required' => 'boolean',
        'status' => 'boolean',
        'deadline_month' => 'integer',
        'deadline_day' => 'integer',
        'benefits_data' => 'array',
        'industry_sectors_data' => 'array',
        'execution_steps_data' => 'array',
        'faqs_data' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($state) {
            if (empty($state->state_slug)) {
                $state->state_slug = Str::slug($state->state_name);
            }
        });
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
}

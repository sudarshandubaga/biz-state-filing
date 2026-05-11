<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $guarded = [];

    protected $casts = [
        'name_available' => 'boolean',
        'needs_registered_agent' => 'boolean',
        'needs_ein' => 'boolean',
        'needs_annual_report_assistance' => 'boolean',
        'entity_specific_data' => 'array',
        'summary_data' => 'array',
        'matched_affiliates' => 'array',
        'delivery_log' => 'array',
        'sent_to_partner' => 'boolean',
        'sent_at' => 'datetime',
    ];

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function routedAffiliate()
    {
        return $this->belongsTo(Affiliate::class, 'routed_to_affiliate_id');
    }
}

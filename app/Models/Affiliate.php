<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Affiliate extends Model
{
    protected $guarded = [];

    protected $casts = [
        'supported_states' => 'array',
        'supported_entity_types' => 'array',
        'services_offered' => 'array',
        'is_available' => 'boolean',
        'status' => 'boolean',
    ];

    public function leads()
    {
        return $this->hasMany(Lead::class, 'routed_to_affiliate_id');
    }
}

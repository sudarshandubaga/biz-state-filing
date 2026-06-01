<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EntityComparison extends Model
{
    protected $guarded = [];

    protected $casts = [
        'status' => 'boolean',
        'sort_order' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function entityType()
    {
        return $this->belongsTo(EntityType::class, 'entity_type_id');
    }

    public function comparedEntityType()
    {
        return $this->belongsTo(EntityType::class, 'compared_entity_type_id');
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}

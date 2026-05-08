<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class EntityType extends Model
{
    protected $guarded = [];

    protected $casts = [
        'status' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($entityType) {
            if (empty($entityType->slug)) {
                $entityType->slug = Str::slug($entityType->name);
            }
        });
    }
}

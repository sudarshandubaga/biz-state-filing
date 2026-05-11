<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Resource extends Model
{
    protected $guarded = [];

    protected $casts = [
        'featured' => 'boolean',
        'status' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($resource) {
            if (empty($resource->slug)) {
                $resource->slug = Str::slug($resource->title);
            }
        });
    }
}

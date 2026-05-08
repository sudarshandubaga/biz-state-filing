<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Country extends Model
{
    public $timestamps = false;

    protected $guarded = [];

    protected $casts = [
        'created_at' => 'datetime',
        'status' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($country) {
            if (empty($country->country_slug)) {
                $country->country_slug = Str::slug($country->country_name);
            }
        });
    }

    public function states(): HasMany
    {
        return $this->hasMany(State::class);
    }
}

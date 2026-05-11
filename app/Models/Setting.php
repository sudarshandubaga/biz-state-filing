<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $guarded = [];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    protected static $row = null;

    public static function getValue($key, $default = null)
    {
        if (static::$row === null) {
            static::$row = static::first();
        }

        if (!static::$row) {
            return $default;
        }

        return static::$row->{$key} ?? $default;
    }
}

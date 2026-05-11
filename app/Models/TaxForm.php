<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaxForm extends Model
{
    protected $guarded = [];
    protected $casts = ['is_official' => 'boolean', 'status' => 'boolean'];
    public function state()
    {
        return $this->belongsTo(State::class);
    }
}

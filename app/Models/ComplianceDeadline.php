<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComplianceDeadline extends Model
{
    protected $guarded = [];
    protected $casts = ['status' => 'boolean'];
    public function state()
    {
        return $this->belongsTo(State::class);
    }
}

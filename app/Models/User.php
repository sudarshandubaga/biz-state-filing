<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Model implements AuthenticatableContract
{
    use HasFactory, Authenticatable;

    protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
        'verification_code',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login_at' => 'datetime',
        'verification_code_sent_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function leads()
    {
        return $this->hasMany(Lead::class, 'user_id');
    }

    public function subscriptions()
    {
        return $this->hasMany(UserSubscription::class);
    }

    public function activeSubscription()
    {
        return $this->hasOne(UserSubscription::class)
            ->where('status', 'active')
            ->where(function ($q) {
                $q->whereNull('expires_at')->orWhere('expires_at', '>', now());
            })
            ->with('plan')
            ->latest();
    }

    public function hasFeature(string $featureKey): bool
    {
        return \App\Helpers\SubscriptionHelper::userHasFeature($this->id, $featureKey);
    }

    public function getPlanSlug(): string
    {
        return \App\Helpers\SubscriptionHelper::getUserPlanSlug($this->id);
    }
}

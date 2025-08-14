<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'product_type',
        'tier',
        'features',
        'price_monthly',
        'price_annual',
        'currency',
        'is_active',
        'display_order',
    ];

    protected $casts = [
        'features' => 'array',
        'is_active' => 'boolean',
    ];

    public const TIERS = [
        'basic' => 'Basic',
        'pro' => 'Professional',
        'enterprise' => 'Enterprise',
    ];

    public function subscriptions()
    {
        return $this->hasMany(UserSubscription::class);
    }

    public function activeSubscriptions()
    {
        return $this->hasMany(UserSubscription::class)
            ->where('ends_at', '>', now())
            ->where('payment_status', 'active');
    }
}

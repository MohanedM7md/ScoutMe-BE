<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSubscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'scout_id',
        'plan_id',
        'starts_at',
        'ends_at',
        'payment_status',
        'renewal_period',
        'auto_renew',
        'payment_method_id',
        'billing_details',
    ];

    protected $casts = [
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
        'auto_renew' => 'boolean',
        'billing_details' => 'array',
    ];

    public const PAYMENT_STATUSES = [
        'active' => 'Active',
        'pending' => 'Pending',
        'canceled' => 'Canceled',
        'failed' => 'Failed',
    ];

    public const RENEWAL_PERIODS = [
        'monthly' => 'Monthly',
        'annual' => 'Annual',
    ];

    public function scout()
    {
        return $this->belongsTo(Scout::class);
    }

    public function plan()
    {
        return $this->belongsTo(SubscriptionPlan::class);
    }

    public function isActive(): bool
    {
        return $this->payment_status === 'active' && $this->ends_at > now();
    }
}

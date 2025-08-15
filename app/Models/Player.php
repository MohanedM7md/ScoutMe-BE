<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Scout\Searchable;

class Player extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'first_name',
        'last_name',
        'display_name',
        'birth_date',
        'height_cm',
        'weight_kg',
        'primary_position',
        'player_image',
        'is_profile_complete',
    ];

    protected $casts = [
        'birth_date' => 'date',
        'is_profile_complete' => 'boolean',
    ];

    public function toSearchableArray()
    {
        return [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'display_name' => $this->display_name,
            'primary_position' => $this->primaryPosition->name ?? null,
        ];
    }
    public function nationalityCountry(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'nationality');
    }

    public function secondNationalityCountry(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'second_nationality');
    }

    public function primaryPosition(): BelongsTo
    {
        return $this->belongsTo(Position::class, 'primary_position');
    }

    public function matchStats(): HasMany
    {
        return $this->hasMany(PlayerMatchStats::class);
    }

    public function aggregatedStats(): HasMany
    {
        return $this->hasMany(PlayerAggregatedStats::class);
    }

    public function getFullNameAttribute(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}

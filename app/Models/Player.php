<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Scout\Searchable;

class Player extends Model
{
    use HasFactory, Searchable;

    protected $fillable = [
        'team_id',
        'first_name',
        'last_name',
        'display_name',
        'player_nationality',
        'birth_date',
        'height_cm',
        'weight_kg',
        'primary_position',
        'player_image',
    ];

    protected $casts = [
        'birth_date' => 'date',
        'is_profile_complete' => 'boolean',
    ];


    public function nationality(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'player_nationality');
    }
    public function primaryPosition(): BelongsTo
    {
        return $this->belongsTo(Position::class, 'primary_position');
    }

    public function team()
    {
        return $this->belongsTo(Club::class, 'team_id');
    }

    public function matches(): BelongsToMany
    {
        return $this->belongsToMany(FootballMatch::class, 'football_match_player', 'player_id', 'match_id')
                    ->withPivot(['played_position']);
    }

    public function playerMatchStats(): HasMany
    {
        return $this->hasMany(PlayerMatchStats::class, 'player_id', 'id');
    }


    public function getFullNameAttribute(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function scopeFilter($query, array $filters)
    {
        if (!empty($filters['position'])) {
            $query->where('primary_position', $filters['position']);
        }

        if (!empty($filters['name'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('first_name', 'like', '%' . $filters['name'] . '%')
                    ->orWhere('last_name', 'like', '%' . $filters['name'] . '%')
                    ->orWhere('display_name', 'like', '%' . $filters['name'] . '%');
            });
        }
        if (!empty($filters['nationality'])) {
            $query->where('player_nationality', $filters['nationality']);
        }

        if(!empty($filters['team_id'])){
            $query->where('team_id', $filters['team_id']);
        }

        
    }
}

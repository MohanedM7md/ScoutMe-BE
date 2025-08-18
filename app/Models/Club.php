<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Club extends Model
{
    use HasFactory;

    protected $fillable = [
        'player_match_stat_id',
        'name',
        'short_name',
        'country_code',
        'club_type',
        'logo_url',
        'is_verified',
    ];

    protected $casts = [
        'is_verified' => 'boolean',
    ];

    public function country(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_code', 'iso_code_3');
    }

    public function homeMatches(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(FootballMatch::class, 'home_team_id');
    }

    public function awayMatches(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(FootballMatch::class, 'away_team_id');
    }

    public function teamStats(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(MatchTeamStats::class, 'club_id');
    }

    public function players(): \Illuminate\Database\Eloquent\Relations\HasManyThrough
    {
        return $this->hasManyThrough(
            Player::class,
            PlayerMatchStats::class,
            'team_id',
            'id',
            'id',
            'player_id'
        )->distinct();
    }
}

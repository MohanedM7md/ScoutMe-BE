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

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_code', 'iso_code_3');
    }

    public function homeMatches()
    {
        return $this->hasMany(FootballMatch::class, 'home_team_id');
    }

    public function awayMatches()
    {
        return $this->hasMany(FootballMatch::class, 'away_team_id');
    }

    public function teamStats()
    {
        return $this->hasMany(MatchTeamStats::class, 'club_id');
    }

    public function players()
    {
        return $this->hasMany(Player::class, 'team_id');
    }
}

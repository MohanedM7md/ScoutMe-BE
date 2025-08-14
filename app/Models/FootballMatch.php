<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FootballMatch extends Model
{
    use HasFactory;

    protected $fillable = [
        'home_team_id',
        'away_team_id',
        'match_date',
        'status',
        'referee',
    ];

    protected $casts = [
        'match_date' => 'datetime',
    ];

    public function homeTeam()
    {
        return $this->belongsTo(Club::class, 'home_team_id');
    }

    public function awayTeam()
    {
        return $this->belongsTo(Club::class, 'away_team_id');
    }

    public function teamStats()
    {
        return $this->hasMany(MatchTeamStats::class);
    }

    public function playerStats()
    {
        return $this->hasMany(PlayerMatchStats::class);
    }

    public function homeTeamStats()
    {
        return $this->hasOne(MatchTeamStats::class)
            ->where('club_id', $this->home_team_id);
    }

    public function awayTeamStats()
    {
        return $this->hasOne(MatchTeamStats::class)
            ->where('club_id', $this->away_team_id);
    }
}

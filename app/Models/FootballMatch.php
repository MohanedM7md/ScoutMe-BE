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

    public function scopeFilter($query, array $filters)
    {
        // Filter by team name
        if (!empty($filters['team'])) {
            $team = $filters['team'];

            $query->where(function ($q) use ($team) {
                $q->whereHas('homeTeam', function ($q2) use ($team) {
                    $q2->where('name', 'like', "%{$team}%");
                })
                    ->orWhereHas('awayTeam', function ($q2) use ($team) {
                        $q2->where('name', 'like', "%{$team}%");
                    });
            });
        }

        // Filter by specific date
        if (!empty($filters['date'])) {
            $query->whereDate('match_date', $filters['date']);
        }

        // Filter by date range
        if (!empty($filters['date_from']) && !empty($filters['date_to'])) {
            $query->whereBetween('match_date', [$filters['date_from'], $filters['date_to']]);
        }
    }
}

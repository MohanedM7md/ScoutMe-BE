<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class FootballMatch extends Model
{
    use HasFactory;

    protected $fillable = [
        'home_team_id',
        'away_team_id',
        'season_id',
        'competition_id',
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
    public function season()
    {
        return $this->belongsTo(Season::class);
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
    public function competition()
    {
        return $this->belongsTo(Competition::class)->withDefault([
            'name' => 'Friendly Match',
            'logo_url' => 'default/league_logo.png'
        ]);
    }
    public function players()
    {
        return $this->hasManyThrough(
            Player::class,
            PlayerMatchStats::class,
            'football_match_id',
            'id',
            'id',
            'player_id'
        )->distinct();
    }
    public function getTeamPlayers(int $teamId)
    {
        return $this->players()
            ->where('team_id', $teamId)
            ->with('player:id,first_name,last_name,display_name')
            ->get();
    }

    public function scopeFilter($query, array $filters)
    {
        // Filter by team name
        if (!empty($filters['team'])) {
            $team = $filters['team'];
            $query->where(function ($q) use ($team) {
                $q->whereHas('homeTeam', function ($q2) use ($team) {
                    $q2->where('name', 'like', "%{$team}%");
                })->orWhereHas('awayTeam', function ($q2) use ($team) {
                    $q2->where('name', 'like', "%{$team}%");
                });
            });
        }

        // Filter by competition name
        if (!empty($filters['competition'])) {
            $competition = $filters['competition'];
            $query->whereHas('competition', function ($q) use ($competition) {
                $q->where('name', 'like', "%{$competition}%");
            });
        }

        // 🔥 Filter by season_id
        if (!empty($filters['season_id'])) {
            $query->where('season_id', $filters['season_id']);
        }

        // 🔥 Filter by season name (e.g., "2023/24")
        if (!empty($filters['season'])) {
            $season = $filters['season'];
            $query->whereHas('season', function ($q) use ($season) {
                $q->where('name', 'like', "%{$season}%");
            });
        }

        // Filter by specific date
        if (!empty($filters['date'])) {
            $query->whereDate('match_date', $filters['date']);
        }

        // Filter by date range
        if (!empty($filters['date_from']) && !empty($filters['date_to'])) {
            $from = Carbon::parse($filters['date_from'])->startOfDay();
            $to   = Carbon::parse($filters['date_to'])->endOfDay();
            $query->whereBetween('match_date', [$from, $to]);
        } elseif (!empty($filters['date_from'])) {
            $from = Carbon::parse($filters['date_from'])->startOfDay();
            $query->where('match_date', '>=', $from);
        } elseif (!empty($filters['date_to'])) {
            $to = Carbon::parse($filters['date_to'])->endOfDay();
            $query->where('match_date', '<=', $to);
        }
    }
}

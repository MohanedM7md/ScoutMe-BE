<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;




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

    public function homeTeam(): BelongsTo
    {
        return $this->belongsTo(Club::class, 'home_team_id');
    }

    public function awayTeam(): BelongsTo
    {
        return $this->belongsTo(Club::class, 'away_team_id');
    }

    public function teamStats(): HasMany
    {
        return $this->hasMany(MatchTeamStats::class);
    }

    public function playerStats(): HasMany
    {
        return $this->hasMany(PlayerMatchStats::class);
    }
    public function season(): BelongsTo
    {
        return $this->belongsTo(Season::class);
    }

    public function homeTeamStats(): HasOne
    {
        return $this->hasOne(MatchTeamStats::class)
            ->where('club_id', $this->home_team_id);
    }

    public function awayTeamStats(): HasOne
    {
        return $this->hasOne(MatchTeamStats::class)
            ->where('club_id', $this->away_team_id);
    }
    public function competition(): BelongsTo
    {
        return $this->belongsTo(Competition::class)->withDefault([
            'name' => 'Friendly Match',
            'logo_url' => 'default/league_logo.png'
        ]);
    }
public function players(): BelongsToMany
{
    return $this->belongsToMany(Player::class, 'football_match_player', 'match_id', 'player_id')
        ->withPivot(['team_id', 'played_position'])
        ->withTimestamps();
}

public function getTeamPlayers(int $teamId)
{
    return $this->players()
        ->wherePivot('team_id', $teamId)
        ->get();
}
    public function scopeFilter($query, array $filters): void
    {
        if (!empty($filters['team_id'])) {
            $teamId = $filters['team_id'];
            $query->where(function ($q) use ($teamId) {
                $q->where('home_team_id', $teamId)
                ->orWhere('away_team_id', $teamId);
            });
        }


        if (!empty($filters['away_id'])) {
            $teamId = $filters['away_id'];
            $query->where(function ($q) use ($teamId) {
                $q->Where('away_team_id', $teamId);
            });
        }

        if (!empty($filters['home_id'])) {
            $teamId = $filters['home_id'];
            $query->where(function ($q) use ($teamId) {
                $q->where('home_team_id', $teamId);
            });
        }
        if (!empty($filters['player_id'])) {
            $playerId = $filters['player_id'];
            $query->whereHas('players', function ($q) use ($playerId) {
                $q->where('players.id', $playerId);
            });
        }
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

        if (!empty($filters['competition_id'])) {
            $query->where('competition_id', $filters['competition_id']);
        }
        if (!empty($filters['competition'])) {
            $competition = $filters['competition'];
            $query->whereHas('competition', function ($q) use ($competition): void {
                $q->where('name', 'like', "%{$competition}%");
            });
        }
        if (!empty($filters['season_id'])) {
            $query->where('season_id', $filters['season_id']);
        }
        if (!empty($filters['season'])) {
            $season = $filters['season'];
            
            $query->whereHas('season', function ($q) use ($season): void {
                $q->where('name', $season);
            });
        }
        if (!empty($filters['date'])) {
            $query->whereDate('match_date', $filters['date']);
        }
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

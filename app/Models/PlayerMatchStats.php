<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayerMatchStats extends Model
{
    use HasFactory;

    protected $fillable = [
        'player_id',
        'match_id',
        'team_id',
        'played_position',
        'minutes_played',
        'starts',
        'substitute_on_min',
        'substitute_off_min',
        'rating',
        'goals',
        'assists',
        'shots_total',
        'shots_on_target',
        'shot_accuracy',
        'passes_attempted',
        'passes_completed',
        'pass_accuracy',
        'dribbles_attempted',
        'dribbles_completed',
        'dribble_success_rate',
        'tackles_attempted',
        'tackles_won',
        'tackle_success_rate',
        'interceptions',
        'clearances',
        'fouls_committed',
        'fouls_suffered',
        'yellow_cards',
        'red_cards',
        'offsides',
        'distance_covered_m',
        'distance_sprinted_m',
        'possession_won',
        'possession_lost',
        'heatmap',
    ];

    protected $casts = [
        'heatmap' => 'array',
        'starts' => 'boolean',
        'match_date' => 'datetime',
    ];

    public function player()
    {
        return $this->belongsTo(Player::class);
    }

    public function match()
    {
        return $this->belongsTo(FootballMatch::class);
    }

    public function team()
    {
        return $this->belongsTo(Club::class, 'team_id');
    }

    public function position()
    {
        return $this->belongsTo(Position::class, 'played_position', 'id');
    }

    public function goalkeeperStats()
    {
        return $this->hasOne(GoalkeeperMatchStats::class, 'id');
    }

    public function defenderStats()
    {
        return $this->hasOne(DefenderMatchStats::class, 'id');
    }

    public function attackerStats()
    {
        return $this->hasOne(AttackerMatchStats::class, 'id');
    }
    public function getPositionSpecificStatsAttribute()
    {
        $positionCategory = $this->position->category ?? null;

        return match ($positionCategory) {
            'Goalkeeper' => $this->goalkeeperStats,
            'Defender' => $this->defenderStats,
            'Forward' => $this->attackerStats,
            default => null,
        };
    }
}

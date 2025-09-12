<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayerMatchStats extends Model
{
    use HasFactory;

    protected $fillable = [
        // Match info
        'player_id',
        'football_match_id',
        'team_id',
        'played_position',
        'is_goalkeeper',
        'season_id',
        // Participation
        'minutes_played',
        'starts',
        'substitute_on_min',
        'substitute_off_min',

        // Attacking stats
        'goals',
        'assists',
        'shots_total',
        'shots_on_target',
        'shot_accuracy',
        'hit_woodwork',
        'big_chances_missed',
        'big_chances_created',
        'touches_in_box',
        'progressive_receptions',
        'dribbles_attempted',
        'dribbles_completed',
        'dribble_success_rate',
        'progressive_carries',
        'offsides',

        // Defending stats
        'tackles',
        'tackles_won',
        'tackle_success_rate',
        'interceptions',
        'clearances',
        'blocks',
        'shot_blocks',
        'recoveries',
        'aerial_duels',
        'aerial_duels_won',
        'ground_duels',
        'ground_duels_won',
        'possession',
        'possession_won',

        // General stats
        'passes_attempted',
        'passes_completed',
        'pass_accuracy',
        'progressive_passes',
        'fouls_committed',
        'fouls_suffered',
        'yellow_cards',
        'red_cards',
        'distance_covered_m',
        'distance_sprinted_m',
        'crosses_attempted',
        'crosses_completed',
        'cross_accuracy',
        'heatmap'
    ];

    protected $casts = [
        'heatmap' => 'array',
        'starts' => 'boolean',
        'match_date' => 'datetime',
    ];

    public function player()
    {
        return $this->belongsTo(Player::class, 'player_id');
    }

    public function FootballMatch()
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
    public function season()
    {
        return $this->belongsTo(Season::class);
    }
    public function isGoalkeeper(): bool
    {
        return $this->played_position === 'GK';
    }
    
}

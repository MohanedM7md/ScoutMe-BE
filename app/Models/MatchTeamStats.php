<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatchTeamStats extends Model
{
    use HasFactory;

    protected $fillable = [
        'football_match_id',
        'season_id',
        'club_id',
        'is_home',
        'goals',
        'goals_conceded',
        'result',
        'penalty_goals',
        'penalty_attempts',
        'free_kick_goals',
        'free_kick_attempts',
        'goals_inside_box',
        'shots_inside_box',
        'goals_outside_box',
        'shots_outside_box',
        'left_foot_goals',
        'right_foot_goals',
        'headed_goals',
        'big_chances',
        'big_chances_missed',
        'shots',
        'shots_on_target',
        'shots_off_target',
        'blocked_shots',
        'successful_dribbles',
        'hit_woodwork',
        'counter_attacks',
        'big_chances_created',
        'expected_goals',
        'possession',
        'passes_attempted',
        'passes_completed',
        'own_half_passes_completed',
        'own_half_passes_attempted',
        'opposition_half_passes_completed',
        'opposition_half_passes_attempted',
        'long_balls_completed',
        'long_balls_attempted',
        'crosses_completed',
        'crosses_attempted',
        'through_balls_completed',
        'progressive_passes',
        'tackles',
        'tackles_won',
        'interceptions',
        'clearances',
        'saves',
        'balls_recovered',
        'errors_leading_to_shot',
        'errors_leading_to_goal',
        'penalties_committed',
        'penalty_goals_conceded',
        'clearances_off_line',
        'last_man_tackles',
        'clean_sheet',
        'duels_won',
        'duels_total',
        'ground_duels_won',
        'ground_duels_total',
        'aerial_duels_won',
        'aerial_duels_total',
        'possession_lost',
        'throw_ins',
        'goal_kicks',
        'offsides',
        'fouls_committed',
        'fouls_suffered',
        'yellow_cards',
        'red_cards',
        'corners',
        'free_kicks'
    ];


    protected $casts = [
        'is_home' => 'boolean',
        'pass_accuracy' => 'float',
        'possession' => 'float',
        'expected_goals' => 'float',
        'shot_accuracy' => 'float',
        'dribble_success_rate' => 'float',
    ];

    public function match()
    {
        return $this->belongsTo(FootballMatch::class);
    }

    public function club()
    {
        return $this->belongsTo(Club::class);
    }
    public function season()
    {
        return $this->belongsTo(Season::class);
    }


    public function getPossessionPercentageAttribute()
    {
        return $this->possession * 100;
    }

    public function getPassAccuracyPercentageAttribute()
    {
        return $this->pass_accuracy * 100;
    }

    public function getShotAccuracyPercentageAttribute()
    {
        return $this->shot_accuracy * 100;
    }
}

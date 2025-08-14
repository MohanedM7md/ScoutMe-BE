<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatchTeamStats extends Model
{
    use HasFactory;

    protected $fillable = [
        'match_id',
        'club_id',
        'is_home',
        'passes_attempted',
        'passes_completed',
        'pass_accuracy',
        'possession',
        'shots',
        'shots_on_target',
        'expected_goals',
        'shot_accuracy',
        'tackles',
        'tackles_won',
        'interceptions',
        'fouls_committed',
        'offsides',
        'corners',
        'free_kicks',
        'penalty_kicks',
        'yellow_cards',
        'red_cards',
        'saves',
        'dribble_success_rate',
    ];

    protected $casts = [
        'is_home' => 'boolean',
        'pass_accuracy' => 'decimal:5,2',
        'possession' => 'decimal:5,2',
        'expected_goals' => 'decimal:5,2',
        'shot_accuracy' => 'decimal:5,2',
        'dribble_success_rate' => 'decimal:5,2',
    ];

    public function match()
    {
        return $this->belongsTo(FootballMatch::class);
    }

    public function club()
    {
        return $this->belongsTo(Club::class);
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

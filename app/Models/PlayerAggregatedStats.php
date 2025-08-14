<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayerAggregatedStats extends Model
{
    use HasFactory;

    protected $fillable = [
        'player_id',
        'stat_type',
        'total_matches',
        'total_minutes',
        'goals',
        'assists',
        'shots_total',
        'shots_on_target',
        'passes_attempted',
        'passes_completed',
        'tackles_attempted',
        'tackles_won',
        'interceptions',
        'clearances',
        'fouls_committed',
        'fouls_suffered',
        'yellow_cards',
        'red_cards',
    ];

    public const STAT_TYPES = [
        'season' => 'Season',
        'career' => 'Career',
    ];

    public function player()
    {
        return $this->belongsTo(Player::class);
    }

    public function getGoalsPer90Attribute(): float
    {
        if ($this->total_minutes === 0) {
            return 0.0;
        }
        return ($this->goals / $this->total_minutes) * 90;
    }

    public function getPassAccuracyAttribute(): float
    {
        if ($this->passes_attempted === 0) {
            return 0.0;
        }
        return ($this->passes_completed / $this->passes_attempted) * 100;
    }

    public function getTackleSuccessRateAttribute(): float
    {
        if ($this->tackles_attempted === 0) {
            return 0.0;
        }
        return ($this->tackles_won / $this->tackles_attempted) * 100;
    }
}

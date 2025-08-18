<?php

namespace App\Models;

use App\Contracts\PositionStats;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DefenderMatchStats extends Model implements PositionStats
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'player_match_stat_id',
        'blocks',
        'shot_blocks',
        'aerial_duels_won',
        'aerial_duels_lost',
        'recoveries',
        'progressive_passes',
        'progressive_carries',
    ];

    public function matchStats()
    {
        return $this->belongsTo(PlayerMatchStats::class, 'id');
    }

    public function getAerialDuelSuccessRateAttribute(): ?float
    {
        $total = $this->aerial_duels_won + $this->aerial_duels_lost;
        if ($total === 0) {
            return null;
        }
        return ($this->aerial_duels_won / $total) * 100;
    }
}

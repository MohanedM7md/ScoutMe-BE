<?php

namespace App\Models;

use App\Contracts\PositionStats;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoalkeeperMatchStats extends Model implements PositionStats
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'player_match_stat_id',
        'saves_total',
        'saves_inside_box',
        'saves_outside_box',
        'penalties_faced',
        'penalties_saved',
        'punches',
        'high_claims',
        'goals_conceded',
        'clean_sheet',
    ];

    protected $casts = [
        'clean_sheet' => 'boolean',
    ];

    public function matchStats()
    {
        return $this->belongsTo(PlayerMatchStats::class, 'id');
    }

    public function getPenaltySaveRateAttribute(): ?float
    {
        if ($this->penalties_faced === 0) {
            return null;
        }
        return ($this->penalties_saved / $this->penalties_faced) * 100;
    }
}

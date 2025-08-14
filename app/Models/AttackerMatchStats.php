<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttackerMatchStats extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'hit_woodwork',
        'big_chances_missed',
        'big_chances_created',
        'touches_in_box',
        'progressive_receptions',
        'successful_dribbles',
        'aerial_duels_won',
    ];

    public function matchStats()
    {
        return $this->belongsTo(PlayerMatchStats::class, 'id');
    }

    public function getBigChanceConversionRateAttribute(): ?float
    {
        if ($this->big_chances_missed === 0) {
            return null;
        }
        return ($this->big_chances_created / ($this->big_chances_created + $this->big_chances_missed)) * 100;
    }
}

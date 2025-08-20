<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    use HasFactory;

    protected $fillable = [
        'competition_id',
        'name',
        'start_date',
        'end_date',
        'is_current'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_current' => 'boolean'
    ];
    public function competitions()
    {
        return $this->belongsToMany(Competition::class, 'competition_season')
            ->withTimestamps();
    }

    public function footballMatches()
    {
        return $this->hasMany(FootballMatch::class);
    }


    public function matchTeamStats()
    {
        return $this->hasMany(MatchTeamStats::class);
    }

    public function playerMatchStats()
    {
        return $this->hasMany(PlayerMatchStats::class);
    }
}

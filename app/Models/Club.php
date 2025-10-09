<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Club extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'short_name',
        'country_code',
        'club_type',
        'logo_url',
        'is_verified',
    ];

    protected $casts = [
        'is_verified' => 'boolean',
    ];

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class, 'country_code', 'iso_code_3');
    }

    public function homeMatches(): HasMany
    {
        return $this->hasMany(FootballMatch::class, 'home_team_id');
    }

    public function awayMatches(): HasMany
    {
        return $this->hasMany(FootballMatch::class, 'away_team_id');
    }

    public function teamStats(): HasMany
    {
        return $this->hasMany(MatchTeamStats::class, 'club_id');
    }

    public function competitions(): BelongsToMany
    {
        return $this->belongsToMany(Competition::class, 'competition_club')
            ->withTimestamps();
    }
    public function players(): HasMany
    {
        return $this->hasMany(Player::class, 'team_id');
    }

    public function scopeWithTeamRecords($query){
        return $query
        ->withCount([
            'teamStats as total_matches',
            'teamStats as wins'   => fn($q) => $q->where('result', 1),
            'teamStats as losses' => fn($q) => $q->where('result', -1),
            'teamStats as draws'  => fn($q) => $q->where('result', 0),
        ]);
    }
    public function scopeByCompetition($query, $competitionId)
    {
        $result = $query->whereHas('competitions', fn($q)=>$q->where('competition_id', $competitionId))->get();
        return $result ;
    }

    public function scopeByCountry($query, $countryCode)
    {
        return $query->where('country_code', $countryCode);
    }

    public function scopeByTeam($query, $teamId)
    {
        return $query->where('id', $teamId);
    }

    public function scopeByName($query, $name)
    {
        if(!empty($name))
        return $query->where(function ($q) use ($name) {
            $q->where('name', 'LIKE', "%{$name}%")
            ->orWhere('short_name', 'LIKE', "%{$name}%");
        });
    }
}


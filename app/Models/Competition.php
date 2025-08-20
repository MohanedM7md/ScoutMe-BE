<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    use HasFactory;

    protected $table = 'competitions';

    protected $fillable = [
        'name',
        'short_name',
        'type',
        'country_code',
        'gender',
        'age_group',
        'logo_url'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];


    public function country()
    {
        return $this->belongsTo(Country::class, 'country_code', 'id');
    }

    public function seasons()
    {
        return $this->belongsToMany(Season::class, 'competition_season')
            ->withTimestamps();
    }
    public function scopeForGender($query, $gender)
    {
        return $query->where('gender', $gender);
    }

    public function scopeForAgeGroup($query, $ageGroup)
    {
        return $query->where('age_group', $ageGroup);
    }
    public function footballMatchs()
    {
        return $this->hasMany(FootballMatch::class, 'league_id');
    }


    public function getFullNameAttribute()
    {
        return $this->short_name
            ? "{$this->name} ({$this->short_name})"
            : $this->name;
    }

    public function setShortNameAttribute($value)
    {
        $this->attributes['short_name'] = $value ? strtoupper($value) : null;
    }

    public function scopeFilter($query, array $filters)
    {
        // Filter by country
        if (!empty($filters['country_code'])) {
            $query->where('country_code', $filters['country_code']);
        }

        // Filter by type (league, cup, etc.)
        if (!empty($filters['type'])) {
            $query->where('type', $filters['type']);
        }
    }
}

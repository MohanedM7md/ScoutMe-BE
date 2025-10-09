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

    public function clubs()
    {
        return $this->belongsToMany(Club::class, 'competition_club')
            ->withTimestamps();
    }
    public function footballMatches()
    {
        return $this->hasMany(FootballMatch::class);
    }
    public function scopeForGender($query, $gender)
    {
        return $query->where('gender', $gender);
    }

    public function scopeForAgeGroup($query, $ageGroup)
    {
        return $query->where('age_group', $ageGroup);
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
        if (!empty($filters['name'])) {
            $query->where('name', 'like', '%' . $filters['name'] . '%');
        }
        if (!empty($filters['country_code'])) {
            $query->where('country_code', $filters['country_code']);
        }

        if (!empty($filters['type'])) {
            $query->where('type', $filters['type']);
        }

        if (!empty($filters['gender'])) {
            $query->where('gender', $filters['gender']);
        }

        if (!empty($filters['age_group'])) {
            $query->where('age_group', $filters['age_group']);
        }

        return $query;
    }
}

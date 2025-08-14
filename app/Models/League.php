<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class League extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'country_code',
        'logo_url',
        'tier',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_code', 'iso_code_3');
    }

    public function matches()
    {
        return $this->hasMany(FootballMatch::class);
    }
}

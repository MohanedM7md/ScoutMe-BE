<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'iso_code_3',
        'continent',
    ];

    public function players()
    {
        return $this->hasMany(Player::class, 'player_nationality', 'id');
    }

    public function clubs()
    {
        return $this->hasMany(Club::class, 'country_code', 'iso_code_3');
    }
}

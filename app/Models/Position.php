<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'full_name',
        'id',
        'category',
    ];

    public const CATEGORIES = [
        'goalkeeper' => 'Goalkeeper',
        'defender' => 'Defender',
        'midfielder' => 'Midfielder',
        'forward' => 'Forward',
    ];

    public function players()
    {
        return $this->hasMany(Player::class, 'primary_position');
    }

    public function matchStats()
    {
        return $this->hasMany(PlayerMatchStats::class, 'played_position');
    }
}

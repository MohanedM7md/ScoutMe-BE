<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JuniorPlayer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'display_name',
        'birth_date',
        'nationality_id',
        'height_cm',
        'weight_kg',
        'primary_position',
        'preferred_foot',
        'player_image',
        'video_url',
        'is_profile_complete',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function nationality()
    {
        return $this->belongsTo(Country::class, 'nationality_id');
    }

    public function primaryPosition()
    {
        return $this->belongsTo(Position::class, 'primary_position_id');
    }
}

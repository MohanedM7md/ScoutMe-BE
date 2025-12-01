<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JuniorPlayer extends Model
{
    use HasFactory;

    protected $fillable = [
        'scout_email',
        'first_name',
        'last_name',
        'display_name',
        'birth_date',
        'gender',
        'email',
        'player_image',
        'positions',
        'primary_position',
        'height_cm',
        'weight_kg',
        'description',
        'phone_number',
        'video_urls',
        'fav_feet',
        'nationality_id',
        'current_club',
        'previous_clubs_info',
        'password',
        'is_profile_complete',
        'is_scout',
        'user_id',
    ];

    protected $casts = [
        'positions' => 'array',
        'video_urls' => 'array',
        'fav_feet' => 'array',
        'is_profile_complete' => 'boolean',
        'is_scout' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function nationality()
    {
        return $this->belongsTo(Country::class, 'nationality_id');
    }
}

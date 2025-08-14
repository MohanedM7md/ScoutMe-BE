<?php

namespace Database\Seeders;

use App\Models\Scout;
use App\Models\User;
use Illuminate\Database\Seeder;

class ScoutsSeeder extends Seeder
{
    public function run()
    {
        $scouts = User::role('scout')->get();

        foreach ($scouts as $user) {
            Scout::create([
                'user_id' => $user->id,
                'name' => $user->id % 2 == 0 ? 'Scouting Club ' . $user->id : 'Scout ' . $user->name,
                'email' => $user->email,
                'phone' => '+123456789' . $user->id,
                'logo_url' => $user->id % 2 == 0 ? null : 'profile-images/scout' . $user->id . '.jpg'
            ]);
        }
    }
}

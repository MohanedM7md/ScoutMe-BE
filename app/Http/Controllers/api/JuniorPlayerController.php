<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterJuniorPlayerRequest;
use App\Http\Requests\UpdateJuniorPlayerRequest;
use App\Http\Resources\JuniorPlayerResource;
use App\Models\JuniorPlayer;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class JuniorPlayerController extends Controller
{

    public function register(RegisterJuniorPlayerRequest $request)
    {

        $user = User::create([
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'user_role' => 'player',
        ]);
        $user->assignRole('player');

        $player = JuniorPlayer::create([
            'user_id'         => $user->id,
            'first_name'      => $request->first_name,
            'last_name'       => $request->last_name,
            'display_name'    => $request->display_name,
            'birth_date'      => $request->birth_date,
            'nationality_id'  => $request->nationality_id,
            'height_cm'       => $request->height_cm,
            'weight_kg'       => $request->weight_kg,
            'primary_position' => $request->primary_position,
            'preferred_foot'  => $request->preferred_foot,
            'player_image'    => $request->player_image,
            'video_url'       => $request->video_url,
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'token'  => $token,
            'player' => new JuniorPlayerResource($player->load('user')),
        ], 201);
    }


    public function updateProfile(UpdateJuniorPlayerRequest $request, $playerId)
    {
        $player = User::findOrFail($playerId)->JuniorPlayer;

        $player->update($request->validated());

        return response()->json([
            'message' => 'Player profile updated successfully',
            'player' => $player
        ]);
    }
}

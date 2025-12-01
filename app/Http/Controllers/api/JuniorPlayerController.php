<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\auth\RegisterJuniorPlayerRequest;
use App\Http\Requests\auth\UpdateJuniorPlayerRequest;
use App\Http\Resources\JuniorPlayerResource;
use App\Models\JuniorPlayer;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class JuniorPlayerController extends Controller
{

   public function register(RegisterJuniorPlayerRequest $request)
{
    // 1️⃣ Create the user
    $user = User::create([
        'email'        => $request->email,
        'password'     => Hash::make($request->password),
        'phone_number' => $request->phone,
        'user_role'    => 'player',
    ]);

    $user->assignRole('player');

    // 2️⃣ Create the JuniorPlayer profile
    $player = JuniorPlayer::create([
        'user_id'         => $user->id,
        'first_name'      => $request->first_name,
        'last_name'       => $request->last_name,
        'display_name'    => $request->display_name,
        'birth_date'      => $request->birth_date,
        'nationality_id'  => $request->nationality_id,
        'height_cm'       => $request->height_cm,
        'weight_kg'       => $request->weight_kg,
        'primary_position'=> $request->primary_position,
        'positions'       => $request->positions ?? [$request->primary_position],
        'video_urls'      => $request->video_urls ?? [],
        'fav_feet'        => $request->fav_feet ?? [],
        'player_image'    => $request->player_image,
        'current_club'    => $request->current_club,
        'previous_clubs_info' => $request->previous_clubs_info,
        'description'     => $request->description,
        'is_profile_complete' => true,
    ]);

    // 3️⃣ Generate API token
    $token = $user->createToken('auth_token')->plainTextToken;

    // 4️⃣ Return JSON resource
    return response()->json([
        'token'  => $token,
        'player' => new JuniorPlayerResource($player->load('user')),
    ], 201);
}


    public function fetchProfile(Request $request)
    {
        $user = $request->user();
        $player = $user->juniorPlayer;

        if (!$player) {
            return response()->json([
                'message' => 'Player profile not found'
            ], 404);
        }

        return new JuniorPlayerResource($player);
    }
    public function updateProfile(UpdateJuniorPlayerRequest $request)
    {
        $user = $request->user();
        $player = $user->JuniorPlayer;
        if (!$player) {
            return response()->json([
                'message' => 'Player profile not found'
            ], 404);
        }
        $player->update($request->validated());

        return response()->json([
            'message' => 'Player profile updated successfully',
            'player' => $player
        ]);
    }
    public function getAllPlayers()
    {
        $players = JuniorPlayer::with('user')->get();

        return JuniorPlayerResource::collection($players);
    }

    public function getPlayer($id)
{
    $player = JuniorPlayer::with('user')->find($id);

    if (!$player) {
        return response()->json(['message' => 'Player not found'], 404);
    }

    return new JuniorPlayerResource($player);
}
    public function deleteProfile(Request $request)
    {
        $user = $request->user();               // authenticated user
        $player = $user->juniorPlayer;          // get related player

        if (!$player) {
            return response()->json([
                'message' => 'Player profile not found'
            ], 404);
        }

        $player->delete();
        $user->delete();
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Player profile deleted successfully'
        ]);
    }
}

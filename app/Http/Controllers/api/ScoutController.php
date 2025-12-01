<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\auth\RegisterScoutRequest;
use App\Http\Resources\users\ScoutResource;
use App\Models\Scout;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Players\AddJuniorPlayerRequest;
use App\Models\JuniorPlayer;
use Illuminate\Support\Facades\Log;
class ScoutController extends Controller
{
    
public function fetchProfile(Request $request)
{
    $user = $request->user();

    // Log the authenticated user
    Log::info('Authenticated user:', ['id' => $user->id, 'email' => $user->email]);

    $scout = $user->scout; // or $user->juniorPlayer if it's a player

    // Log the related scout/player
    if ($scout) {
        Log::info('Related profile found:', ['profile' => $scout->toArray()]);
    } else {
        Log::warning('No related profile found for user', ['user_id' => $user->id]);
    }

    if (!$scout) {
        return response()->json([
            'message' => 'Player profile not found'
        ], 404);
    }

    return new ScoutResource($scout);
}

    public function register(RegisterScoutRequest $request)
    {
        // Create user
        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone_number' => $request->phone_number,
            'user_role' => 'scout',
        ]);

        $user->assignRole('scout');
        $scout = Scout::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'logo_url' => $request->logo_url,
            'notes' => $request->notes,
            'country_id' => $request->country_id,
        ]);

        $token = $user->createToken('scout_token')->plainTextToken;

        return response()->json([
            'token'  => $token,
            'scout' => new ScoutResource($scout->load('user')),
        ], 201);
    }

    public function updateProfile(RegisterScoutRequest $request): JsonResponse
    {
        $scout = $request->user()->scout;
        $validated = $request->validated();

        $scout->update($validated);
        return response()->json([
            'message' => 'Profile updated successfully',
            'scout' => new ScoutResource($scout->fresh()),
        ]);
    }



    public function addJunior(AddJuniorPlayerRequest $request)
    {

        $user = $request->user();

        $player = JuniorPlayer::create([
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
            'is_scout'        => true,
            'scout_email'     => $user->email,
        ]);
        return response()->json([
            'player' =>  $player,
        ], 201);
    }

}

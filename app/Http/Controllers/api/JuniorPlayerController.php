<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\JuniorPlayer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;



class JuniorPlayerController extends Controller
{
    public function register(Request $request)
    {
        $validated = $request->validate([
            // User fields
            'name'            => 'required|string|max:255',
            'email'           => 'required|string|email|max:255|unique:users',
            'password'        => ['required', 'confirmed', Rules\Password::defaults()],

            // Player fields
            'first_name'      => 'required|string|max:100',
            'last_name'       => 'required|string|max:100',
            'display_name'    => 'nullable|string|max:100',
            'birth_date'      => 'nullable|date',
            'nationality_id'  => 'nullable|exists:countries,id',
            'height_cm'       => 'nullable|integer',
            'weight_kg'       => 'nullable|integer',
            'primary_position' => 'required|exists:positions,id',
            'preferred_foot'  => 'nullable|in:left,right,both',
            'player_image'    => 'nullable|string',
            'video_url'       => 'nullable|string',
        ]);

        // Extract subsets
        $userData = collect($validated)->only([
            'name',
            'email',
            'password'
        ])->toArray();

        $playerData = collect($validated)->only([
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
            'video_url'
        ])->toArray();

        // Hash password & add role
        $user = User::create([
            ...$userData,
            'password'  => Hash::make($userData['password']),
            'user_role' => 'player'
        ]);
        $user->assignRole('player');

        // Create player profile
        $player = JuniorPlayer::create([
            ...$playerData,
            'user_id' => $user->id,
        ]);

        // Merge into single JSON
        return response()->json([
            'player' => array_merge(
                $user->only(['id', 'email', 'user_role', 'created_at']),
                $player->toArray()
            )
        ], 201);
    }

    public function updateProfile(Request $request)
    {
        $player = $request->user()->player;

        $validated = $request->validate([
            'first_name'      => 'sometimes|string|max:100',
            'last_name'       => 'sometimes|string|max:100',
            'display_name'    => 'nullable|string|max:100',
            'birth_date'      => 'nullable|date',
            'nationality_id'  => 'nullable|exists:countries,id',
            'height_cm'       => 'nullable|integer',
            'weight_kg'       => 'nullable|integer',
            'primary_position' => 'sometimes|exists:positions,id',
            'preferred_foot'  => 'nullable|in:left,right,both',
            'player_image'    => 'nullable|string',
            'video_url'       => 'nullable|string',
        ]);

        $player->update($validated);

        return response()->json($player);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\auth\RegisterScoutRequest;
use App\Http\Requests\auth\ScoutUpdateProfileRequest;
use App\Http\Resources\ScoutResource;
use App\Http\Resources\ScoutWithTokenResource;
use App\Http\Resources\UserResource;
use App\Models\Scout;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ScoutController extends Controller
{
    public function fetchProfile(Request $request): JsonResponse
    {
        $user = $request->user();
        $scout = $user->scout;

        if (!$scout) {
            return response()->json([
                'message' => 'Player profile not found'
            ], 404);
        }

        return response()->json(
            $scout
        );
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


        // Create scout profile
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
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Scout;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ScoutController extends Controller
{
    /**
     * Get the authenticated scout profile
     */
    public function getProfile(Request $request)
    {
        return response()->json([
            'user' => $request->user(),
            'scout' => $request->user()->scout,
        ]);
    }

    /**
     * Register a new scout
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            // User data
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',

            // Scout-specific fields
            'phone' => 'sometimes|nullable|string|max:20',
            'logo_url' => 'sometimes|nullable|string',
            'notes' => 'sometimes|nullable|string',

            // If you want country ISO code
            'country_id' => 'sometimes|nullable|string|size:2|exists:countries,id',
        ]);

        // Create user
        $user = User::create([
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'user_role' => 'scout',
        ]);

        // Assign role (if using Spatie roles/permissions)
        $user->assignRole('scout');

        // Create scout profile
        $scout = Scout::create([
            'user_id' => $user->id,
            'name' => $validated['name'],
            'phone' => $validated['phone'] ?? null,
            'logo_url' => $validated['logo_url'] ?? null,
            'notes' => $validated['notes'] ?? null,
            'country_id' => $validated['country_id'] ?? null,
        ]);

        // Issue Sanctum token
        $token = $user->createToken('scout_token')->plainTextToken;

        return response()->json([
            'message' => 'Scout created successfully',
            'user' => array_merge($user->only(['id', 'email', 'user_role', 'created_at']), $scout->toArray()),
            'token' => $token,
        ], 201);
    }

    /**
     * Update scout profile
     */
    public function updateProfile(Request $request)
    {
        $scout = $request->user()->scout;

        $validated = $request->validate([
            'phone' => 'sometimes|nullable|string|max:20',
            'logo_url' => 'sometimes|nullable|string',
            'notes' => 'sometimes|nullable|string',
            'country_id' => 'sometimes|nullable|string|size:2|exists:countries,id',
        ]);

        $scout->update($validated);

        return response()->json([
            'message' => 'Profile updated successfully',
            'user' => array_merge(
                $scout->toArray()
            )
        ]);
    }
}

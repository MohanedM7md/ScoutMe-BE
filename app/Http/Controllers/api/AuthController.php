<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        // Find user
        $user = User::where('email', $credentials['email'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        // Revoke old tokens (optional)
        $user->tokens()->delete();

        // Create new token
        $token = $user->createToken('auth_token')->plainTextToken;

        // Load related profile (player or scout)
        $profile = null;
        if ($user->role === 'player') {
            $profile = $user->player;
        } elseif ($user->role === 'scout') {
            $profile = $user->scout;
        }

        return response()->json([
            'token'   => $token,
            'user'    => $user,
            'profile' => $profile,
        ]);
    }


    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Logged out successfully']);
    }
    public function me(Request $request)
    {
        $user = $request->user();

        $profile = null;
        if ($user->role === 'player') {
            $profile = $user->player;
        } elseif ($user->role === 'scout') {
            $profile = $user->scout;
        }

        return response()->json([
            'user'    => $user,
            'profile' => $profile,
        ]);
    }
}

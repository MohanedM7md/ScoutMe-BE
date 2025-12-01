<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\auth\LoginRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Log;
class AuthController extends Controller
{
public function login(LoginRequest $request)
{
    $email = $request->email;
    $password = $request->password;

    Log::info('Login attempt', [
        'email' => $email,
        'password' => '***hidden***' // Never log plain passwords!
    ]);

    $user = User::where('email', $email)->first();

    if (!$user) {
        Log::warning("Login failed: user not found", ['email' => $email]);
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    if (!Hash::check($password, $user->password)) {
        Log::warning("Login failed: wrong password", ['email' => $email]);
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    Log::info('Login successful', ['email' => $email, 'user_id' => $user->id]);

    $token = $user->createToken('auth_token')->plainTextToken;

    return response()->json([
        'token' => $token,
        'user'  => new UserResource($user),
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

        if ($user->role === 'player') {
            $user->load('player');
        } elseif ($user->role === 'scout') {
            $user->load('scout');
        }

        return new UserResource($user);
    }
}

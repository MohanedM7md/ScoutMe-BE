<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return response()->json(User::with(['scout'])->paginate(15));
    }

    public function show(User $user)
    {
        return response()->json($user->load('scout'));
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'email' => 'sometimes|email|unique:users,email,' . $user->id,
            'user_role' => 'sometimes|in:scout,admin,player',
            'is_verified' => 'sometimes|boolean'
        ]);

        $user->update($validated);

        if ($request->has('user_role')) {
            $user->syncRoles([$validated['user_role']]);
        }

        return response()->json($user->load('scout'));
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(['message' => 'User deleted']);
    }
}

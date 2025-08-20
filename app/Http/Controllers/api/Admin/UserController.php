<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;

class UserController extends Controller
{

    public function index()
    {

        $users = User::with(['scout', 'player'])->paginate(15);

        return UserResource::collection($users);
    }


    public function show(User $user)
    {
        return new UserResource($user->load(['scout', 'player']));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->validated());


        if ($request->has('user_role')) {
            $user->syncRoles([$request->get('user_role')]);
        }


        return new UserResource($user->load(['scout', 'player']));
    }


    public function destroy(User $user)
    {
        $user->delete();

        return response()->json([
            'message' => 'User deleted successfully.'
        ], 204);
    }
}

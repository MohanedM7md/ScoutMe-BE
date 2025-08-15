<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Scout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScoutController extends Controller
{
    public function getProfile(Request $request)
    {
        return response()->json($request->user()->scout);
    }

    public function updateProfile(Request $request)
    {
        $scout = $request->user()->scout;

        $validated = $request->validate([
            'name' => 'sometimes|string|max:100',
            'phone' => 'sometimes|nullable|string|max:20',
            'profile_image' => 'sometimes|nullable|string',
            'logo_url' => 'sometimes|nullable|string',
            'notes' => 'sometimes|nullable|string',
        ]);

        $scout->update($validated);

        return response()->json($scout);
    }
}

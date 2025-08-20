<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Competition;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminCompetitionController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name'         => ['required', 'string', 'max:100'],
                'short_name'   => ['nullable', 'string', 'max:50'],
                'type'         => ['required', Rule::in(['league', 'friendly', 'tournament'])],
                'country_code' => ['nullable', 'string', 'size:2', 'exists:countries,id'],
                'gender'       => ['nullable', Rule::in(['men', 'women'])],
                'age_group'    => ['nullable', 'string', 'max:20'],
                'logo_url'     => ['nullable', 'url'],
            ]);

            $competition = Competition::create($validated);

            return response()->json([
                'message' => 'Competition created successfully.',
                'data'    => $competition
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->validator->errors()
            ], 422);
        }
    }

    public function update(Request $request, Competition $competition)
    {
        try {
            $validated = $request->validate([
                'name'         => ['sometimes', 'string', 'max:100'],
                'short_name'   => ['nullable', 'string', 'max:50'],
                'type'         => ['sometimes', Rule::in(['league', 'friendly', 'tournament'])],
                'country_code' => ['nullable', 'string', 'size:2', 'exists:countries,id'],
                'gender'       => ['nullable', Rule::in(['men', 'women'])],
                'age_group'    => ['nullable', 'string', 'max:20'],
                'logo_url'     => ['nullable', 'url'],
            ]);

            $competition->update($validated);

            return response()->json([
                'message' => 'Competition updated successfully.',
                'data'    => $competition
            ], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->validator->errors()
            ], 422);
        }
    }

    public function destroy(Competition $competition)
    {
        $competition->delete();

        return response()->json([
            'message' => 'Competition deleted successfully.'
        ], 200);
    }
}

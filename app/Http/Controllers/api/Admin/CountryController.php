<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    // Show all countries
    public function index()
    {
        return response()->json(Country::all());
    }

    // Store new country
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'iso_code_3' => 'required|string|size:3|unique:countries,iso_code_3',
            'continent' => 'required|string|max:255',
        ]);

        $country = Country::create($validated);

        return response()->json($country, 201);
    }

    // Show single country
    public function show(Country $country)
    {
        return response()->json($country->load(['players', 'clubs']));
    }

    // Update country
    public function update(Request $request, Country $country)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'iso_code_3' => 'sometimes|string|size:3|unique:countries,iso_code_3,' . $country->id,
            'continent' => 'sometimes|string|max:255',
        ]);

        $country->update($validated);

        return response()->json($country);
    }

    // Delete country
    public function destroy(Country $country)
    {
        $country->delete();

        return response()->json(['message' => 'Country deleted successfully']);
    }
}

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\JuniorPlayerController;

Route::post('/player/register', [JuniorPlayerController::class, 'register']);


// -----------------------------
// -----------------------------
Route::middleware('auth:sanctum')->group(function () {

    // Get logged-in player's profile
    Route::get('/players/profile', [JuniorPlayerController::class, 'getAllPlayers']);

    // Update profile
    Route::get('/player/profile/{id}', [JuniorPlayerController::class, 'getPlayer']);

    // Delete profile + user + token
    Route::delete('/player/profile', [JuniorPlayerController::class, 'deleteProfile']);
});

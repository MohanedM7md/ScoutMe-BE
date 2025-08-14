<?php

use App\Http\Controllers\Api\PlayerController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('players', PlayerController::class)->only(['index', 'show']);

    // Additional player routes
    Route::get('players/{player}/stats', [PlayerController::class, 'getStats']);
    Route::get('players/search', [PlayerController::class, 'search']);
});

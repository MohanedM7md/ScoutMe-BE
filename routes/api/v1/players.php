<?php

use App\Http\Controllers\Api\PlayerController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('players', PlayerController::class)->only(['index', 'show']);
    Route::get('players/search', [PlayerController::class, 'search']);
});

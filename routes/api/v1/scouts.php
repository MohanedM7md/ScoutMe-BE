<?php

use App\Http\Controllers\Api\ScoutController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'role:scout'])->group(function () {
    Route::get('/profile', [ScoutController::class, 'getProfile']);
    Route::put('/profile', [ScoutController::class, 'updateProfile']);
    Route::apiResource('/players', PlayerController::class)->only(['index', 'show']);
});

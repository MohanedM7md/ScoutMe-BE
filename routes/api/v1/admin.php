<?php

use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\AdminPlayerController;
use App\Http\Controllers\Api\AdminMatchController;
use App\Http\Controllers\Api\AdminStatsController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'role:admin'])->prefix('admin')->group(function () {
    Route::apiResource('users', AdminController::class);
    Route::apiResource('players', AdminPlayerController::class);
    Route::apiResource('matches', AdminMatchController::class);
    Route::post('/matches/team-stat', [AdminStatsController::class, 'updateTeamStats']);
    Route::post('/matches/player-stat', [AdminStatsController::class, 'updatePlayerStats']);
});

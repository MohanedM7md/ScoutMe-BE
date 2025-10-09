<?php

use App\Http\Controllers\Api\MatchController;
use Illuminate\Support\Facades\Route;

Route::get('matches/{match}/stats', [MatchController::class, 'getMatchStats']);
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('matches', MatchController::class)->only(['index', 'show']);
    Route::get('/matches/{match}/players', [MatchController::class, 'getPlayersByTeam']);
    Route::get('/matches/{match}/player-stats', [MatchController::class, 'getPlayerStatsById']);
});

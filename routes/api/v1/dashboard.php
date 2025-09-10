<?php

use App\Http\Controllers\Api\DashboardController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/dashboard/players', [DashboardController::class, 'getTopPlayers']);
    Route::get('/dashboard/competitions', [DashboardController::class, 'getTopCompetetion']);
    Route::get('/dashboard/matches', [DashboardController::class, 'getRecentMatchs']);
});

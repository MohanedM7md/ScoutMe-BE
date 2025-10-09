<?php

use App\Http\Controllers\Api\Admin\CompetitionController;
use App\Http\Controllers\Api\Admin\CountryController;
use App\Http\Controllers\Api\Admin\MatchController;
use App\Http\Controllers\Api\Admin\PlayerController;
use App\Http\Controllers\Api\Admin\StatsController;
use App\Http\Controllers\Api\Admin\UserController;
use App\Http\Controllers\Api\Admin\SeasonController;
use App\Http\Controllers\Api\Admin\ClubController;
use App\Http\Controllers\Api\Admin\PositionController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'role:admin'])->prefix('admin')->group(function () {
    Route::apiResource('countries', CountryController::class);

    Route::apiResource('users', UserController::class);
    
    Route::apiResource('players', PlayerController::class);

    Route::apiResource('positions', PositionController::class);
    
    Route::apiResource('clubs', ClubController::class);
    
    Route::apiResource('competitions', CompetitionController::class);
    
    Route::apiResource('matches', MatchController::class);
    
    Route::apiResource('seasons', SeasonController::class);
    

    Route::post('team-stat', [StatsController::class, 'storeTeamStats']);
    Route::put('team-stat/{match}/{clubId}', [StatsController::class, 'updateTeamStats']);
    Route::delete('team-stat/{match}/{clubId}', [StatsController::class, 'deleteTeamStats']);

    Route::post('player-stat', [StatsController::class, 'storePlayerStats']);
    Route::put('player-stat/{match}/{playerId}', [StatsController::class, 'updatePlayerStats']);
    Route::delete('player-stat/{match}/{playerId}', [StatsController::class, 'deletePlayerStats']);
});

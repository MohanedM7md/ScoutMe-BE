<?php

use App\Http\Controllers\Api\TeamsController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('teams/standing', [TeamsController::class,'fetchTeamsStandings' ]);
    Route::get('teams/{team}', [TeamsController::class, 'fetchTeamSeasonStats']);
    Route::get('teams/profile/{team}', [TeamsController::class,'fetchTeamProfile' ]);
});

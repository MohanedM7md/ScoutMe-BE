<?php

use App\Http\Controllers\Api\TeamsController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('teams/comparison', [TeamsController::class,'fetchTeamsComparasion' ]);
    Route::get('teams/standing', [TeamsController::class,'fetchTeamsStandings' ]);
    Route::get('teams/profile/{team}', [TeamsController::class,'fetchTeamProfile' ]);
    Route::get('teams/{team}', [TeamsController::class, 'fetchTeamSeasonStats']);
});

<?php

use App\Http\Controllers\Api\TeamsController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('teams/standing', [TeamsController::class,'fetchTeamsStandings' ]);
});

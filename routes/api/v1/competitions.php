<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CompetitionController;



// Competition routes

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/competitions', [CompetitionController::class, 'index']);
    Route::get('/competitions/{competition}', [CompetitionController::class, 'show']);
    Route::get('/competitions/{competition}/matches', [CompetitionController::class, 'getMatches']);
});

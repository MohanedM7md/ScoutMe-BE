<?php

use App\Http\Controllers\Api\MatchController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('matches', MatchController::class)->only(['index', 'show']);
    Route::get('matches/{match}/stats', [MatchController::class, 'getMatchStats']);
});

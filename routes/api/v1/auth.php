<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\JuniorPlayerController;
use App\Http\Controllers\api\ScoutController;


Route::post('/register/scout', [ScoutController::class, 'register']);
Route::post('/register/scout-player', [JuniorPlayerController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::put('/scout-player/{playerId}', [JuniorPlayerController::class, 'updateProfile']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'getAuthenticatedUser']);
});

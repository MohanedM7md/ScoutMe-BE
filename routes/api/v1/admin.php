<?php

use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\AdminMatchController;
use App\Http\Controllers\Api\AdminPlayerController;
use App\Http\Controllers\Api\SubscriptionController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'role:admin'])->prefix('admin')->group(function () {
    Route::apiResource('users', AdminController::class);
    Route::apiResource('players', AdminPlayerController::class);
    Route::apiResource('matches', AdminMatchController::class);
});

<?php

use App\Http\Controllers\Api\AdminController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'role:admin'])->prefix('admin')->group(function () {
    Route::apiResource('users', AdminController::class);
    Route::apiResource('players', AdminPlayerController::class);
    Route::apiResource('matches', AdminMatchController::class);
    Route::apiResource('subscription-plans', SubscriptionPlanController::class);
});

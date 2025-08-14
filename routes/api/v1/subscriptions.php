<?php

use App\Http\Controllers\Api\SubscriptionController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum', 'role:scout'])->group(function () {
    Route::get('/subscription/plans', [SubscriptionController::class, 'getPlans']);
    Route::post('/subscription/subscribe', [SubscriptionController::class, 'subscribe']);
    Route::get('/subscription/status', [SubscriptionController::class, 'getStatus']);
    Route::post('/subscription/cancel', [SubscriptionController::class, 'cancel']);
});

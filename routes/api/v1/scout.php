<?php

use App\Http\Controllers\Api\ScoutController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::post('scouts/add', [ScoutController::class, 'addJunior']);
});

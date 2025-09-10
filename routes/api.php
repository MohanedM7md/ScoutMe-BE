<?php

use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    require __DIR__ . '/api/v1/auth.php';
    require __DIR__ . '/api/v1/players.php';
    require __DIR__ . '/api/v1/matches.php';
    require __DIR__ . '/api/v1/competitions.php';
    require __DIR__ . '/api/v1/subscriptions.php';
    require __DIR__ . '/api/v1/dashboard.php';
    require __DIR__ . '/api/v1/admin.php';
    require __DIR__ . '/api/v1/teams.php';
});

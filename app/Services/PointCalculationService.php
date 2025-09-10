<?php

namespace App\Services;

class PointCalculationService
{
    public static function calculatePoints(int $wins, int $draws, int $losses = 0): int
    {
        return ($wins * 3) + ($draws * 1) + ($losses * 0);
    }
}
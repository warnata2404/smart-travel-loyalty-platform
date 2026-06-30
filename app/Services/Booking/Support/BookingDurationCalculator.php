<?php

namespace App\Services\Booking\Support;

use App\Models\Route;

class BookingDurationCalculator
{
    /**
     * Get estimated duration from route.
     */
    public function calculate(Route $route): int
    {
        return $route->estimated_duration_minutes;
    }
}

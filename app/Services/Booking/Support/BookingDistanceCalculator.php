<?php

namespace App\Services\Booking\Support;

use App\Models\Route;

class BookingDistanceCalculator
{
    /**
     * Get travel distance from route.
     */
    public function calculate(Route $route): float
    {
        return (float) $route->distance_km;
    }
}

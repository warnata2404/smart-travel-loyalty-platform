<?php

namespace App\Services\Booking\Support;

use App\Models\Route;

class BookingPriceCalculator
{
    /**
     * Get base price from route.
     */
    public function calculate(Route $route): float
    {
        return (float) $route->base_price;
    }
}

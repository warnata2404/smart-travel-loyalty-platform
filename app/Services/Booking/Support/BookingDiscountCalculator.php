<?php

namespace App\Services\Booking\Support;

class BookingDiscountCalculator
{
    /**
     * Calculate discount amount.
     */
    public function calculate(
        float $price,
        float $percentage
    ): float {
        return round(
            ($price * $percentage) / 100,
            2
        );
    }
}

<?php

namespace App\Services\Booking\Support;

class BookingFinalPriceCalculator
{
    /**
     * Calculate final price.
     */
    public function calculate(
        float $price,
        float $discount
    ): float {
        return max(
            0,
            round($price - $discount, 2)
        );
    }
}

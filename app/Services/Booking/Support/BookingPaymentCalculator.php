<?php

namespace App\Services\Booking\Support;

class BookingPaymentCalculator
{
    /**
     * Calculate booking payment.
     */
    public function calculate(
        float $price,
        float $discountPercentage
    ): array {
        $discount = round(
            ($price * $discountPercentage) / 100,
            2
        );

        return [
            'discount_amount' => $discount,
            'final_price' => round(
                $price - $discount,
                2
            ),
        ];
    }
}

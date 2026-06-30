<?php

namespace App\Services\Booking\Support;

class BookingCodeService
{
    /**
     * Generate unique booking code.
     */
    public function generate(): string
    {
        return 'BK-'
            . now()->format('YmdHis')
            . '-'
            . random_int(1000, 9999);
    }
}

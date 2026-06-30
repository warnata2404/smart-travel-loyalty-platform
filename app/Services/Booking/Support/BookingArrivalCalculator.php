<?php

namespace App\Services\Booking\Support;

use Carbon\Carbon;

class BookingArrivalCalculator
{
    /**
     * Calculate estimated arrival datetime.
     */
    public function calculate(
        Carbon $departure,
        int $durationMinutes
    ): Carbon {
        return $departure->copy()->addMinutes($durationMinutes);
    }
}

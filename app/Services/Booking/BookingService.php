<?php

namespace App\Services\Booking;

use App\Models\Booking;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class BookingService
{
    /**
     * Get paginated bookings.
     */
    public function paginate(
        int $perPage = 10
    ): LengthAwarePaginator {
        return Booking::query()
            ->with([
                'user',
                'route.originDestination',
                'route.destinationDestination',
                'voucher',
            ])
            ->latest()
            ->paginate($perPage);
    }

    /**
     * Store booking.
     */
    public function create(array $data): Booking
    {
        return Booking::create($data);
    }

    /**
     * Update booking.
     */
    public function update(
        Booking $booking,
        array $data
    ): Booking {
        $booking->update($data);

        return $booking->fresh([
            'user',
            'route.originDestination',
            'route.destinationDestination',
            'voucher',
        ]);
    }

    /**
     * Delete booking.
     */
    public function delete(
        Booking $booking
    ): bool {
        return (bool) $booking->delete();
    }
}

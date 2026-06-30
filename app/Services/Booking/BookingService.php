<?php

namespace App\Services\Booking;

use App\Models\Booking;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use App\DTO\BookingSnapshotData;

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
     * Create booking from prepared snapshot.
     */
    public function createFromSnapshot(
        array $attributes,
        BookingSnapshotData $snapshot
    ): Booking {
        return Booking::create([
            ...$attributes,

            'origin_name' => $snapshot->originName,
            'destination_name' => $snapshot->destinationName,

            'estimated_distance_km' => $snapshot->distanceKm,
            'estimated_duration_minutes' => $snapshot->durationMinutes,
            'estimated_arrival_datetime' => $snapshot->arrivalDatetime,

            'base_price' => $snapshot->basePrice,
        ]);
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

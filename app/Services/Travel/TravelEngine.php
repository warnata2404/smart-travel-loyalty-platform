<?php

namespace App\Services\Travel;

use App\DTO\BookingSnapshotData;
use App\Models\Route;
use App\Services\Booking\BookingService;
use App\Services\Booking\Support\BookingCodeService;
use App\Services\Booking\Support\BookingSnapshotService;
use App\Services\Loyalty\LoyaltyRuleService;
use App\Services\Voucher\Support\VoucherCodeService;
use App\Services\Voucher\VoucherService;
use Carbon\Carbon;
use App\Models\Booking;
use Illuminate\Support\Facades\DB;

class TravelEngine
{
    public function __construct(
        private readonly BookingService $bookingService,
        private readonly BookingSnapshotService $bookingSnapshotService,
        private readonly BookingCodeService $bookingCodeService,
        private readonly VoucherService $voucherService,
        private readonly VoucherCodeService $voucherCodeService,
        private readonly LoyaltyRuleService $loyaltyRuleService,
    ) {}

    /**
     * Generate booking code.
     */
    public function generateBookingCode(): string
    {
        return $this->bookingCodeService->generate();
    }

    /**
     * Build booking snapshot.
     */
    public function buildSnapshot(
        Route $route,
        Carbon $departure
    ): BookingSnapshotData {
        return $this->bookingSnapshotService->build(
            $route,
            $departure
        );
    }

    /**
     * Create booking transaction.
     */
    public function createBooking(
        array $attributes,
        Route $route,
        Carbon $departure
    ): Booking {
        return DB::transaction(function () use (
            $attributes,
            $route,
            $departure
        ) {
            $snapshot = $this->buildSnapshot(
                $route,
                $departure
            );

            return $this->bookingService->createFromSnapshot(
                [
                    ...$attributes,
                    'booking_code' => $this->generateBookingCode(),
                ],
                $snapshot
            );
        });
    }
}

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
}

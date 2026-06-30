<?php

namespace App\Services\Booking\Support;

use App\DTO\BookingSnapshotData;
use App\Models\Route;
use Carbon\Carbon;

class BookingSnapshotService
{
    public function __construct(
        private readonly BookingPriceCalculator $priceCalculator,
        private readonly BookingDistanceCalculator $distanceCalculator,
        private readonly BookingDurationCalculator $durationCalculator,
        private readonly BookingArrivalCalculator $arrivalCalculator,
    ) {}

    /**
     * Build booking snapshot from selected route.
     */
    public function build(
        Route $route,
        Carbon $departure
    ): BookingSnapshotData {
        $distance = $this->distanceCalculator->calculate($route);

        $duration = $this->durationCalculator->calculate($route);

        return new BookingSnapshotData(
            originName: $route->originDestination->name,
            destinationName: $route->destinationDestination->name,
            distanceKm: $distance,
            durationMinutes: $duration,
            arrivalDatetime: $this->arrivalCalculator->calculate(
                $departure,
                $duration
            ),
            basePrice: $this->priceCalculator->calculate($route),
        );
    }
}

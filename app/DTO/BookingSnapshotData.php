<?php

namespace App\DTO;

use Carbon\Carbon;

readonly class BookingSnapshotData
{
    public function __construct(
        public string $originName,
        public string $destinationName,
        public float $distanceKm,
        public int $durationMinutes,
        public Carbon $arrivalDatetime,
        public float $basePrice,
    ) {}
}

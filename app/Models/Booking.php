<?php

namespace App\Models;

use App\Enums\BookingStatus;
use App\Enums\TravelCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Booking Model
 *
 * Represents a travel booking transaction.
 */
class Booking extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'booking_code',
        'user_id',
        'route_id',

        'travel_category',

        'origin_name',
        'destination_name',

        'departure_datetime',
        'estimated_distance_km',
        'estimated_duration_minutes',
        'estimated_arrival_datetime',

        'base_price',
        'discount_percentage',
        'discount_amount',
        'final_price',

        'payment_proof_path',
        'payment_uploaded_at',

        'booking_status',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'travel_category' => TravelCategory::class,

            'departure_datetime' => 'datetime',

            'estimated_arrival_datetime' => 'datetime',

            'estimated_distance_km' => 'decimal:2',

            'base_price' => 'decimal:2',

            'discount_percentage' => 'decimal:2',

            'discount_amount' => 'decimal:2',

            'final_price' => 'decimal:2',

            'payment_uploaded_at' => 'datetime',

            'booking_status' => BookingStatus::class,
        ];
    }
}

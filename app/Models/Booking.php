<?php

namespace App\Models;

use App\Enums\BookingStatus;
use App\Enums\TravelCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Booking Model.
 *
 * Represents a travel booking transaction.
 *
 * @property int $id
 * @property string $booking_code
 * @property int $user_id
 * @property int $route_id
 * @property TravelCategory $travel_category
 * @property string $origin_name
 * @property string $destination_name
 * @property \Illuminate\Support\Carbon $departure_datetime
 * @property string $estimated_distance_km
 * @property int $estimated_duration_minutes
 * @property \Illuminate\Support\Carbon $estimated_arrival_datetime
 * @property string $base_price
 * @property string $discount_percentage
 * @property string $discount_amount
 * @property string $final_price
 * @property string|null $payment_proof_path
 * @property \Illuminate\Support\Carbon|null $payment_uploaded_at
 * @property BookingStatus $booking_status
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
     * @return array<string, mixed>
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

    /**
     * Get the user that owns the booking.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the selected travel route.
     */
    public function route(): BelongsTo
    {
        return $this->belongsTo(Route::class);
    }

    /**
     * Get the voucher generated from this booking.
     */
    public function voucher(): HasOne
    {
        return $this->hasOne(
            Voucher::class,
            'used_booking_id'
        );
    }
}

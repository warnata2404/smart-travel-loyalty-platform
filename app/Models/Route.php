<?php

namespace App\Models;

use App\Enums\RouteStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


/**
 * Route Model
 *
 * @property int $id
 * @property int $origin_destination_id
 * @property int $destination_destination_id
 * @property string $distance_km
 * @property int $estimated_duration_minutes
 * @property string $base_price
 * @property RouteStatus $route_status
 */
class Route extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'origin_destination_id',
        'destination_destination_id',
        'distance_km',
        'estimated_duration_minutes',
        'base_price',
        'route_status',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'distance_km' => 'decimal:2',
            'base_price' => 'decimal:2',
            'route_status' => RouteStatus::class,
        ];
    }

    /**
     * Origin destination.
     */
    public function originDestination(): BelongsTo
    {
        return $this->belongsTo(
            Destination::class,
            'origin_destination_id'
        );
    }

    /**
     * Destination.
     */
    public function destinationDestination(): BelongsTo
    {
        return $this->belongsTo(
            Destination::class,
            'destination_destination_id'
        );
    }

    /**
     * Bookings using this route.
     */
    public function bookings(): HasMany
    {
        return $this->hasMany(
            Booking::class
        );
    }
}

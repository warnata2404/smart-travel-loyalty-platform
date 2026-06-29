<?php

namespace App\Models;

use App\Enums\DestinationStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Destination Model
 *
 * @property int $id
 * @property string $name
 * @property DestinationStatus $destination_status
 */
class Destination extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'destination_status',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'destination_status' => DestinationStatus::class,
        ];
    }

    /**
     * Get all routes where this destination is used as the origin.
     */
    public function originRoutes(): HasMany
    {
        return $this->hasMany(
            Route::class,
            'origin_destination_id'
        );
    }

    /**
     * Get all routes where this destination is used as the destination.
     */
    public function destinationRoutes(): HasMany
    {
        return $this->hasMany(
            Route::class,
            'destination_destination_id'
        );
    }
}

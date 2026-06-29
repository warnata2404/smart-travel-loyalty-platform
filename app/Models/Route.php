<?php

namespace App\Models;

use App\Enums\RouteStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Route Model
 *
 * @property int $id
 * @property int $destination_id
 * @property string $origin_name
 * @property string $destination_name
 * @property float $distance_km
 * @property int $estimated_duration_minutes
 * @property float $base_price
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
        'destination_id',
        'origin_name',
        'destination_name',
        'distance_km',
        'estimated_duration_minutes',
        'base_price',
        'route_status',
    ];

    /**
     * Attribute casting.
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
}

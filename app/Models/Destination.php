<?php

namespace App\Models;

use App\Enums\DestinationStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}

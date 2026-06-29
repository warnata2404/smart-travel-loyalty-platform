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
 * @property string|null $description
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
        'description',
        'destination_status',
    ];

    /**
     * Attribute casting.
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

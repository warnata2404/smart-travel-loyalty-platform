<?php

namespace App\Models;

use App\Enums\VoucherStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Voucher Model
 *
 * Represents a loyalty reward voucher.
 */
class Voucher extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'voucher_code',

        'user_id',

        'loyalty_rule_id',

        'used_booking_id',

        'milestone_km',

        'discount_percentage',

        'voucher_status',

        'used_at',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'milestone_km' => 'decimal:2',

            'discount_percentage' => 'decimal:2',

            'voucher_status' => VoucherStatus::class,

            'used_at' => 'datetime',
        ];
    }

    /**
     * Voucher owner.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Loyalty rule that generated this voucher.
     */
    public function loyaltyRule(): BelongsTo
    {
        return $this->belongsTo(LoyaltyRule::class);
    }

    /**
     * Booking where this voucher was redeemed.
     */
    public function usedBooking(): BelongsTo
    {
        return $this->belongsTo(
            Booking::class,
            'used_booking_id'
        );
    }
}

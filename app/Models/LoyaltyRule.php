<?php

namespace App\Models;

use App\Enums\LoyaltyRuleStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * LoyaltyRule Model
 *
 * @property int $id
 * @property float $milestone_km
 * @property float $discount_percentage
 * @property LoyaltyRuleStatus $loyalty_rule_status
 */
class LoyaltyRule extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'milestone_km',
        'discount_percentage',
        'loyalty_rule_status',
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
            'loyalty_rule_status' => LoyaltyRuleStatus::class,
        ];
    }
}

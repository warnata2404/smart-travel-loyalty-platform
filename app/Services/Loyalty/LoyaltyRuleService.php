<?php

namespace App\Services\Loyalty;

use App\Models\LoyaltyRule;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class LoyaltyRuleService
{
    /**
     * Get paginated loyalty rules.
     */
    public function paginate(int $perPage = 10): LengthAwarePaginator
    {
        return LoyaltyRule::query()
            ->latest()
            ->paginate($perPage);
    }

    /**
     * Get all loyalty rules.
     */
    public function all(): Collection
    {
        return LoyaltyRule::query()
            ->orderBy('milestone_km')
            ->get();
    }

    /**
     * Find loyalty rule by id.
     */
    public function find(int $id): LoyaltyRule
    {
        return LoyaltyRule::findOrFail($id);
    }

    /**
     * Create loyalty rule.
     *
     * @param array<string, mixed> $data
     */
    public function create(array $data): LoyaltyRule
    {
        return LoyaltyRule::create($data);
    }

    /**
     * Update loyalty rule.
     *
     * @param array<string, mixed> $data
     */
    public function update(
        LoyaltyRule $loyaltyRule,
        array $data,
    ): LoyaltyRule {
        $loyaltyRule->update($data);

        return $loyaltyRule->fresh();
    }

    /**
     * Delete loyalty rule.
     */
    public function delete(
        LoyaltyRule $loyaltyRule,
    ): bool {
        return (bool) $loyaltyRule->delete();
    }
}

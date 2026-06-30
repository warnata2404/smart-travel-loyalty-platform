<?php

namespace App\Services\Voucher;

use App\Models\Voucher;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class VoucherService
{
    /**
     * Get paginated vouchers.
     */
    public function paginate(
        int $perPage = 10
    ): LengthAwarePaginator {
        return Voucher::query()
            ->with([
                'user',
                'loyaltyRule',
                'usedBooking',
            ])
            ->latest()
            ->paginate($perPage);
    }

    /**
     * Store voucher.
     */
    public function create(array $data): Voucher
    {
        return Voucher::create($data);
    }

    /**
     * Update voucher.
     */
    public function update(
        Voucher $voucher,
        array $data
    ): Voucher {
        $voucher->update($data);

        return $voucher->fresh([
            'user',
            'loyaltyRule',
            'usedBooking',
        ]);
    }

    /**
     * Delete voucher.
     */
    public function delete(
        Voucher $voucher
    ): bool {
        return (bool) $voucher->delete();
    }
}

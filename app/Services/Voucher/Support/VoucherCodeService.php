<?php

namespace App\Services\Voucher\Support;

class VoucherCodeService
{
    /**
     * Generate unique voucher code.
     */
    public function generate(): string
    {
        return 'VC-'
            . now()->format('YmdHis')
            . '-'
            . random_int(1000, 9999);
    }
}

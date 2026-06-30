<?php

namespace App\Http\Requests\Voucher;

use App\Enums\VoucherStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateVoucherRequest extends FormRequest
{
    /**
     * Determine whether the user is authorized.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get validation rules.
     *
     * @return array<string, array<int, mixed>|string>
     */
    public function rules(): array
    {
        return [
            'voucher_code' => [
                'required',
                'string',
                'max:30',
                Rule::unique('vouchers', 'voucher_code')
                    ->ignore($this->route('voucher')),
            ],

            'user_id' => [
                'required',
                'integer',
                'exists:users,id',
            ],

            'loyalty_rule_id' => [
                'required',
                'integer',
                'exists:loyalty_rules,id',
            ],

            'used_booking_id' => [
                'nullable',
                'integer',
                'exists:bookings,id',
            ],

            'milestone_km' => [
                'required',
                'numeric',
                'min:0',
            ],

            'discount_percentage' => [
                'required',
                'numeric',
                'min:0',
                'max:100',
            ],

            'voucher_status' => [
                'required',
                Rule::enum(VoucherStatus::class),
            ],

            'used_at' => [
                'nullable',
                'date',
            ],
        ];
    }
}

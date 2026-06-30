<?php

namespace App\Http\Requests\LoyaltyRule;

use App\Enums\LoyaltyRuleStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateLoyaltyRuleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
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

            'loyalty_rule_status' => [
                'required',
                Rule::enum(LoyaltyRuleStatus::class),
            ],
        ];
    }
}

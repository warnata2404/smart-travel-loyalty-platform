<?php

namespace App\Http\Requests\Route;

use App\Enums\RouteStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRouteRequest extends FormRequest
{
    /**
     * Determine whether the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Validation rules.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'origin_destination_id' => [
                'required',
                'integer',
                'exists:destinations,id',
                'different:destination_destination_id',
            ],

            'destination_destination_id' => [
                'required',
                'integer',
                'exists:destinations,id',
                'different:origin_destination_id',
            ],

            'distance_km' => [
                'required',
                'numeric',
                'min:0',
            ],

            'estimated_duration_minutes' => [
                'required',
                'integer',
                'min:0',
            ],

            'base_price' => [
                'required',
                'numeric',
                'min:0',
            ],

            'route_status' => [
                'required',
                Rule::enum(RouteStatus::class),
            ],
        ];
    }
}

<?php

namespace App\Http\Requests\Booking;

use App\Enums\BookingStatus;
use App\Enums\TravelCategory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBookingRequest extends FormRequest
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
            'booking_code' => [
                'required',
                'string',
                'max:30',
                Rule::unique('bookings', 'booking_code')
                    ->ignore($this->route('booking')),
            ],

            'user_id' => [
                'required',
                'integer',
                'exists:users,id',
            ],

            'route_id' => [
                'required',
                'integer',
                'exists:routes,id',
            ],

            'travel_category' => [
                'required',
                Rule::enum(TravelCategory::class),
            ],

            'origin_name' => [
                'required',
                'string',
                'max:100',
            ],

            'destination_name' => [
                'required',
                'string',
                'max:100',
            ],

            'departure_datetime' => [
                'required',
                'date',
            ],

            'estimated_distance_km' => [
                'required',
                'numeric',
                'min:0',
            ],

            'estimated_duration_minutes' => [
                'required',
                'integer',
                'min:0',
            ],

            'estimated_arrival_datetime' => [
                'required',
                'date',
                'after:departure_datetime',
            ],

            'base_price' => [
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

            'discount_amount' => [
                'required',
                'numeric',
                'min:0',
            ],

            'final_price' => [
                'required',
                'numeric',
                'min:0',
            ],

            'payment_proof_path' => [
                'nullable',
                'string',
                'max:255',
            ],

            'payment_uploaded_at' => [
                'nullable',
                'date',
            ],

            'booking_status' => [
                'required',
                Rule::enum(BookingStatus::class),
            ],
        ];
    }
}

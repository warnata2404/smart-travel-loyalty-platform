<?php

namespace App\Http\Requests\Destination;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateDestinationRequest extends FormRequest
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
        $destination = $this->route('destination');

        $destinationId = is_object($destination)
            ? $destination->id
            : $destination;

        return [
            'name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('destinations', 'name')
                    ->ignore($destinationId),
            ],

            'destination_status' => [
                'required',
                Rule::in([
                    'Active',
                    'Inactive',
                ]),
            ],
        ];
    }
}

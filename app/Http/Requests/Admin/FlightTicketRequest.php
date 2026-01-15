<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class FlightTicketRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $value = 'string|min:2|max:240|unique:ma_flight_tickets,ticket_no';
        if (in_array(request()->method(), ['PUT', 'PATCH'])) {
            $value = 'string|min:2|max:240|unique:ma_flight_tickets,ticket_no,' . (int)request()->id;
        }
        return [
            'airline_id' => 'integer|exists:airlines,id',
            'traveller_name' => 'string|min:2|max:240',
            'from_city' => 'string|min:2|max:240',
            'to_city' => 'string|min:2|max:240',
            'price' => 'nullable|numeric|min:0',
            'airline_com' => 'nullable|numeric|min:0',
            'additional_fees' => 'nullable|numeric|min:0',
            'book_date' => 'nullable|date',
            'travel_date' => 'nullable|date|after_or_equal:book_date',
            'client_id' => 'integer|exists:clients,id',
            'discount' => 'nullable|numeric|min:0',

            'from_transite_place' => 'nullable|array',
            'from_transite_place.*' => 'nullable|string|min:2|max:240',
            'to_transite_place' => 'nullable|array',
            'to_transite_place.*' => 'nullable|string|min:2|max:240',
            'ticket_no' => $value,

        ];
    }
}

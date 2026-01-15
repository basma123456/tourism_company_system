<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;
use App\Enums\TourismFileTypesEnum;

class TourismFileRequest extends FormRequest
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
        return [
//            'Ftype' => [
//                'required',
//                new Enum(TourismFileTypesEnum::class),
//            ],
            'Ftype' => 'required|integer|exists:ma_company_fields,id',
            'Fname' => 'required|string|nullable',
            'emp' => 'required|integer|exists:clients,id',
            'adults_no' => 'nullable|integer',
            'child_no' => 'nullable|integer',
            'infants_no' => 'nullable|integer',
            'arrival_date' => 'required|date',
            'leave_date' => 'required|date',
            'nationality' => 'required|integer|exists:countries,id',
            'created_date' => 'required|date',
            'closed' => 'nullable|boolean',
            'approved' => 'nullable|boolean',
        ];
    }
}

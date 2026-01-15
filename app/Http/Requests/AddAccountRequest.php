<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddAccountRequest extends FormRequest
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
            'parent_id'=> '',
            'name'=> 'required',
            'code' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'code.required'=> 'حقل الكود مطلوب',
            'name.required' => 'حقل الاسم مطلوب',
           // 'date_from.required'=> __('lang.date_fromrequired'),
        ];
    }
}

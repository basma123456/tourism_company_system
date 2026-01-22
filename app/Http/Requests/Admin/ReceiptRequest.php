<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use App\Enums\ReceiptType;
use App\Enums\PayType;

class ReceiptRequest extends FormRequest
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
        $arr = [];
        $arr1 = [
            'Rtype' => [
                'required',
                new Enum(ReceiptType::class),
            ],
//        'Rtype'=> 'required|string',
//            'pay_type'=> 'required|string',


            'amount' => 'required|numeric|decimal:0,2|min:0',
            'currency' => 'required|integer|exists:currencies,id',
            'name' => 'required|string|min:2|max:170',
            'notes' => 'nullable|string|min:2|max:170',
            'pay_type' => [
                'required',
                new Enum(PayType::class),
            ],
            'pay_file' => [
                Rule::requiredIf(fn () => in_array(request()->pay_type, ['transfer', 'check'])),
                'file',
                'mimetypes:application/pdf,image/jpeg,image/png',
                'max:2048',
            ],            'shift_id' => 'nullable|integer',
            'acc_id' => 'required|exists:ma_accounts,accountid',
            'acc_detail_type' => 'nullable|string',
            'acc_details_id' => 'nullable|integer',
            'approve' =>  'nullable|in:yes,no',
            'approve_note' => 'nullable|string',
            'printed' => "nullable|boolean",
            'posted' =>   'nullable|in:yes,no',
            'by_id'=> "nullable|exists:users,id",
            'Rcreated_date'=> "nullable|date",
//            'Rcreated_date',
//            'by_id',
        ];
        $arr = $arr1;
        if (request()->routeIs('admin.receipt.update')) {
            $arr = array_merge($arr1, [
//                'approve' => 'nullable|in:yes,no',
//                'printed' => "nullable|boolean",
//                'posted' =>   'nullable|in:yes,no'
                    'pay_file' =>
                        'nullable|file|mimetypes:application/pdf,image/jpeg,image/png|max:2048' ,

                ]
            );
        }

        return $arr;
    }
}

<?php

use App\Models\Account;
use App\Models\CompanyField;
use Livewire\Component;
use Livewire\Attributes\On;

new class extends Component
{
    public ?int $acc_id = null; // selected account ID
    public ?int $field_id = null; // derived field_id
    public $accounts = [];
    public $check;
    public $companyField = '';

    public function mount($accounts = [])
    {
         $this->accounts = collect($accounts);
     }


    public function setAccount($acc_id)
    {
        $this->acc_id = $acc_id;
    }

#[On('acc-changed')]
    public function funcUpdatedAccId($value)
    {

        $this->companyField = null;
        if (!$value) {
            $this->field_id = null;
            $this->companyField = null;
            return;
        }
        $account = $this->accounts->firstWhere('accountid', (int)$value);
        if (!$account) {
            $this->field_id = null;
            $this->companyField = null;
            return;
        }
        $this->field_id = (int)$account->field_id;
        $this->companyField = CompanyField::whereHas('accounts', function ($q) {
            $q->where('id', $this->field_id);
        })->first();


    }


};
?>


<div class="row">

    <div class="col-6">

        <label class="col-form-label">Account {{$field_id}}</label>
        <select id="accounts" data-toggle="select2" name="acc_id"
                class="form-control select2" wire:ignore>
            @foreach($accounts as $account)
                <option value="{{ $account->accountid }}"
                >
                    {{ $account->name }}
                </option>
            @endforeach
        </select>
        @error('acc_id')
        <div class="text-danger">{{$message}}</div> @enderror

    </div>



    @if( $companyField )

        <div class="col-6 ">
            <label class="col-form-label">acc_details_id</label>

            <select name="acc_details_id" class="form-control">

                <option value="{{ $companyField->id }}">
                    {{ $companyField->name }}
                </option>
            </select>

            @error('acc_details_id')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    @endif



     {{-- Loader --}}
    <div class="col-12 text-center"   wire:loading>
        <i class="spinner-border spinner-border-sm text-primary"></i>
        Loading...
    </div>

{{--    --}}{{-- Result --}}
{{--    <div class="col-6" wire:loading.remove wire:target="funcUpdatedAccId">--}}
{{--        @if($companyField)--}}
{{--            {{ $companyField->name }}--}}
{{--        @endif--}}
{{--    </div>--}}
</div>


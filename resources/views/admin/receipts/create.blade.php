{{--@extends('admin.master')--}}

{{--@section('content')--}}
{{--    <div class="page-container">--}}

{{--        <div class="col-12 d-flex flex-wrap justify-content-between align-items-center my-3">--}}
{{--            <div class="col-8 col-md-8 mb-2 mb-md-0">--}}
{{--                <h4 class="header-title">Add Receipt</h4>--}}
{{--            </div>--}}
{{--            <div class="col-4 col-md-4 text-center text-md-end">--}}
{{--                <a href="{{ route('admin.receipt.index', ['type' => $type]) }}"--}}
{{--                   class="btn btn-soft-info rounded-pill float-end">--}}
{{--                    <i class="ri-arrow-go-back-line"></i>--}}
{{--                    <span class="d-none d-sm-inline"> Back </span>--}}
{{--                </a>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <div class="col-lg-12">--}}
{{--            <div class="card">--}}
{{--                <div class="card-body">--}}

{{--                    --}}{{-- Display validation errors --}}
{{--                    @if ($errors->any())--}}
{{--                        @foreach ($errors->all() as $error)--}}
{{--                            <div class="text-danger">{{ $error }}</div>--}}
{{--                        @endforeach--}}
{{--                        <br>--}}
{{--                    @endif--}}

{{--                    <form action="{{ route('admin.receipt.store', ['type' => $type]) }}" method="POST"--}}
{{--                          class="form-horizontal" enctype="multipart/form-data">--}}
{{--                        @csrf--}}

{{--                        <div class="row">--}}

{{--                            --}}{{-- Receipt Type --}}
{{--                            <div class="col-md-6">--}}
{{--                                <label class="col-form-label">Receipt Type</label>--}}
{{--                                <select name="Rtype" class="form-control">--}}
{{--                                    --}}{{--                                    <option value="in" @if($type == 'in') selected @endif>In</option>--}}
{{--                                    --}}{{--                                    <option value="out" @if($type == 'out') selected @endif>Out</option>--}}
{{--                                    @foreach($rTypes as $rType)--}}
{{--                                        --}}{{--                                    <option value="cash">Cash</option>--}}
{{--                                        --}}{{--                                    <option value="transfer">Transfer</option>--}}
{{--                                        <option--}}
{{--                                            value="{{$rType->value }}" {{ $type ==  $rType->value ? 'selected' : ''}} >{{$rType->label()}}</option>--}}
{{--                                    @endforeach--}}

{{--                                </select>--}}
{{--                            </div>--}}


{{--                            <div class="col-md-6">--}}
{{--                                <label class="col-form-label"> Account </label>--}}
{{--                                <select name="acc_id" class="form-control">--}}
{{--                                    --}}{{--                                    <option value="in" @if($type == 'in') selected @endif>In</option>--}}
{{--                                    --}}{{--                                    <option value="out" @if($type == 'out') selected @endif>Out</option>--}}
{{--                                    @foreach($accounts  as $account)--}}
{{--                                        --}}{{--                                    <option value="cash">Cash</option>--}}
{{--                                        --}}{{--                                    <option value="transfer">Transfer</option>--}}
{{--                                        <option--}}
{{--                                            value="{{$account->accountid  }}" {{ $account->accountid  == old('acc_id')? 'selected' : ''}} >{{$account->name}}</option>--}}
{{--                                    @endforeach--}}

{{--                                </select>--}}
{{--                            </div>--}}

{{--                            --}}{{-- Amount --}}
{{--                            <div class="col-md-6">--}}
{{--                                <label class="col-form-label">Amount</label>--}}
{{--                                <input type="number" step="0.01" name="amount" class="form-control"--}}
{{--                                       placeholder="Amount">--}}
{{--                            </div>--}}

{{--                            --}}{{-- Currency --}}
{{--                            <div class="col-md-6 ">--}}
{{--                                <label class="col-form-label">Currency</label>--}}
{{--                                @foreach($currencies  as $currency)--}}
{{--                                    --}}{{--                                    <option value="cash">Cash</option>--}}
{{--                                    --}}{{--                                    <option value="transfer">Transfer</option>--}}
{{--                                    <select name="currency" class="form-control">--}}
{{--                                        <option--}}
{{--                                            value="{{$currency->id  }}" {{ $currency->id  == old('currency')? 'selected' : ''}} >{{$currency->name}}</option>--}}
{{--                                    </select>--}}
{{--                                @endforeach--}}

{{--                                --}}{{--                                <input type="text" name="currency" class="form-control"--}}
{{--                                --}}{{--                                       placeholder="USD">--}}
{{--                            </div>--}}

{{--                            --}}{{-- Name --}}
{{--                            <div class="col-md-6">--}}
{{--                                <label class="col-form-label">Name</label>--}}
{{--                                <input type="text" name="name" class="form-control"--}}
{{--                                       placeholder="Name">--}}
{{--                            </div>--}}

{{--                            --}}{{-- Payment Type --}}
{{--                            <div class="col-md-6">--}}
{{--                                <label class="col-form-label">Payment Type</label>--}}
{{--                                <select name="pay_type" class="form-control">--}}
{{--                                    @foreach($payTypes as $pType)--}}
{{--                                        <option value="{{$pType->value }}">{{$pType->label()}}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                            </div>--}}


{{--                            --}}{{-- Notes --}}
{{--                            <div class="col-md-6">--}}
{{--                                <label class="col-form-label">Notes</label>--}}
{{--                                <textarea name="notes" class="form-control" rows="3"--}}
{{--                                          placeholder="Notes"></textarea>--}}
{{--                            </div>--}}


{{--                            --}}{{-- Payment File --}}
{{--                            <div class="col-md-6">--}}
{{--                                <label class="col-form-label">Payment File</label>--}}
{{--                                <input type="file" name="pay_file" class="form-control"--}}
{{--                                       placeholder="File path / reference">--}}
{{--                            </div>--}}


{{--                            --}}{{-- Approval Note --}}
{{--                            <div class="col-md-6">--}}
{{--                                <label class="col-form-label">Approve Note</label>--}}
{{--                                <textarea   name="approve_note" rows="3" class="form-control">{{old('approve_notes')}}</textarea>--}}
{{--                            </div>--}}
{{--                            --}}{{-- Approval --}}
{{--                            <div class="col-md-3 mt-3 ">--}}
{{--                                --}}{{--                                <label class="col-form-label"></label>--}}
{{--                                --}}{{--                                <select name="approve" class="form-control">--}}
{{--                                --}}{{--                                    <option value="no">No</option>--}}
{{--                                --}}{{--                                    <option value="yes">Yes</option>--}}
{{--                                --}}{{--                                </select>--}}


{{--                                <div class="form-check form-switch mt-4">--}}

{{--                                    <label class="form-check-label" style="margin: auto" for="closed">Approve</label>--}}
{{--                                    <input id="closed" class="form-check-input " style="margin: auto" type="checkbox" value="yes" name="approve">--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            --}}{{-- Submit Button --}}
{{--                            <div class="col-12 d-flex justify-content-end mt-4">--}}
{{--                                <button type="submit" class="btn btn-primary rounded-pill px-4">--}}
{{--                                    <i class="ri-save-line"></i> Add Receipt--}}
{{--                                </button>--}}
{{--                            </div>--}}

{{--                        </div>--}}
{{--                    </form>--}}

{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endsection--}}
@extends('admin.master')

@section('content')
    <div class="page-container">

        {{-- Page Header --}}
        <div class="col-12 d-flex flex-wrap justify-content-between align-items-center my-3">
            <div class="col-8 col-md-8 mb-2 mb-md-0">
                <h4 class="header-title">Create Receipt</h4>
            </div>
            <div class="col-4 col-md-4 text-center text-md-end">
                <a href="{{ route('admin.receipt.index', ['type' => $type]) }}"
                   class="btn btn-soft-info rounded-pill float-end">
                    <i class="ri-arrow-go-back-line"></i>
                    <span class="d-none d-sm-inline"> Back </span>
                </a>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    {{-- Display validation errors --}}
{{--                    @if ($errors->any())--}}
{{--                        @foreach ($errors->all() as $error)--}}
{{--                            <div class="text-danger">{{ $error }}</div>--}}
{{--                        @endforeach--}}
{{--                        <br>--}}
{{--                    @endif--}}
                    {{-- Success Message --}}
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('admin.receipt.store', ['type' => $type]) }}"
                          method="POST" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            {{-- Name --}}
                            <div class="col-md-4">
                                <label class="col-form-label">Name</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                                @error('name')     <div class="text-danger">{{$message}}</div> @enderror

                            </div>

                            {{-- Amount --}}
                            <div class="col-md-2">
                                <label class="col-form-label">Amount</label>
                                <input type="number" step="0.01" name="amount" class="form-control"
                                       value="{{ old('amount') }}">
                                @error('amount')     <div class="text-danger">{{$message}}</div> @enderror

                            </div>
                            {{-- Currency --}}
                            <div class="col-md-2">
                                <label class="col-form-label">Currency</label>
                                <select name="currency" class="form-control">
                                    @foreach($currencies as $currency)
                                        <option value="{{ $currency->id }}"
                                            {{ old('currency') == $currency->id ? 'selected' : '' }}>
                                            {{ $currency->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('currency')     <div class="text-danger">{{$message}}</div> @enderror

                            </div>

                            {{-- Payment Type --}}
                            <div class="col-md-4">
                                <label  class="col-form-label ">Payment Type</label>
                                <div class="mt-2">
                                 @foreach($payTypes as $pType)

                                    <input class="form-check-input" id="id_{{$pType->value}}"  {{$pType->value == $payTypes[0]->value ? 'checked' : '' }} type="radio" name="pay_type"
                                           value="{{ $pType->value }}"
                                        {{ old('pay_type') == $pType->value ? 'checked' : '' }}>
                                    <label for="id_{{$pType->value}}"> {{ $pType->label() }}</label>

                                @endforeach
                                </div>
                                @error('pay_type')     <div class="text-danger">{{$message}}</div> @enderror

                            </div>


                            {{-- Payment File --}}
                            <div class="col-md-3">
                                <label class="col-form-label">Payment File</label>
                                <input type="file" name="pay_file" class="form-control">
                           @error('pay_file')     <div class="text-danger">{{$message}}</div> @enderror
                            </div>

                            {{-- Account --}}
{{--                            <div class="col-md-3">--}}
{{--                                <label class="col-form-label">Account</label>--}}
{{--                                <select name="acc_id" class="form-control">--}}
{{--                                    @foreach($accounts as $account)--}}
{{--                                        <option value="{{ $account->accountid }}"--}}
{{--                                            {{ old('acc_id') == $account->accountid ? 'selected' : '' }}>--}}
{{--                                            {{ $account->name }}--}}
{{--                                        </option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                                @error('acc_id')     <div class="text-danger">{{$message}}</div> @enderror--}}

{{--                            </div>--}}



                            {{-- Receipt Date --}}
                            <div class="col-md-3">
                                <label class="col-form-label">Rcreated_date</label>
                                <input type="date" name="Rcreated_date" class="form-control"
                                       value="{{ old('Rcreated_date', date('Y-m-d')) }}">
                                @error('Rcreated_date')     <div class="text-danger">{{$message}}</div> @enderror

                            </div>


                            {{-- Receipt Type --}}
                            <div class="col-md-6 d-none">
                                <label class="col-form-label">Receipt Type</label>
                                <input readonly type="text" name="Rtype" value="{{$type}}">
                                @error('Rtype')     <div class="text-danger">{{$message}}</div> @enderror

                            </div>
                            <div class="col-md-6">
                            <livewire:pages::admin.receipt_accounts.get :accounts="$accounts" />
                            </div>
                            {{-- Notes --}}
                            <div class="col-md-6">
                                <label class="col-form-label">Notes</label>
                                <textarea name="notes" class="form-control" rows="3">{{ old('notes') }}</textarea>
                                @error('notes')     <div class="text-danger">{{$message}}</div> @enderror

                            </div>



                            {{--//end--}}







                            {{--                            --}}{{-- Account Details --}}
                            {{--                            <div class="col-md-6">--}}
                            {{--                                <label class="col-form-label">acc_detail_type</label>--}}
                            {{--                                <input type="text" name="acc_detail_type" class="form-control"--}}
                            {{--                                       value="{{ old('acc_detail_type') }}">--}}
                            {{--                            </div>--}}

                            {{--                            --}}{{-- By Admin --}}
                            {{--                            <div class="col-md-6">--}}
                            {{--                                <label class="col-form-label">By Admin</label>--}}
                            {{--                                <select name="by_id" class="form-control">--}}
                            {{--                                    @foreach ($users as $user)--}}
                            {{--                                        <option value="{{ $user->id }}" {{ old('by_id') == $user->id ? 'selected' : '' }}>--}}
                            {{--                                            {{ $user->name }}--}}
                            {{--                                        </option>--}}
                            {{--                                    @endforeach--}}
                            {{--                                </select>--}}
                            {{--                            </div>--}}



                            {{--                            --}}{{-- Approve Note --}}
                            {{--                            <div class="col-md-6">--}}
                            {{--                                <label class="col-form-label">Approve Note</label>--}}
                            {{--                                <textarea name="approve_note" class="form-control" rows="3">{{ old('approve_note') }}</textarea>--}}
                            {{--                            </div>--}}

                            {{--                            --}}{{-- Approve Checkbox --}}
                            {{--                            <div class="col-md-2 mt-4">--}}
                            {{--                                <div class="form-check form-switch">--}}
                            {{--                                    <input id="approve" class="form-check-input" type="checkbox" name="approve" value="yes"--}}
                            {{--                                        {{ old('approve') === 'yes' ? 'checked' : '' }}>--}}
                            {{--                                    <label class="form-check-label" for="approve">Approve</label>--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}

                            {{--                            --}}{{-- Posted Checkbox --}}
                            {{--                            <div class="col-md-2 mt-4">--}}
                            {{--                                <div class="form-check form-switch">--}}
                            {{--                                    <input id="posted" class="form-check-input" type="checkbox" name="posted" value="yes"--}}
                            {{--                                        {{ old('posted') === 'yes' ? 'checked' : '' }}>--}}
                            {{--                                    <label class="form-check-label" for="posted">Posted</label>--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}

                            {{--                            --}}{{-- Printed Checkbox --}}
                            {{--                            <div class="col-md-2 mt-4">--}}
                            {{--                                <div class="form-check form-switch">--}}
                            {{--                                    <input id="printed" class="form-check-input" type="checkbox" name="printed" value="1"--}}
                            {{--                                        {{ old('printed') ? 'checked' : '' }}>--}}
                            {{--                                    <label class="form-check-label" for="printed">Printed</label>--}}
                            {{--                                </div>--}}
                            {{--                            </div>--}}

                            {{-- Submit Button --}}
                            <div class="col-12 d-flex justify-content-end mt-4">
                                <button type="submit" class="btn btn-primary rounded-pill px-4">
                                    <i class="ri-save-line"></i> Create Receipt
                                </button>
                            </div>

                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>

         document.addEventListener('livewire:init', () => {

             function initSelect2() {
                 $('#accounts')
                     .select2()
                     .on('change', function () {
                         Livewire.dispatch('acc-changed', {
                             value: $(this).val()
                         })
                     })
             }

             initSelect2()

             Livewire.hook('morphed', () => {
                 initSelect2()
             })
         })







       </script>
    @endsection

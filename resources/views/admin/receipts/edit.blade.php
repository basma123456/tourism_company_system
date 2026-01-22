@extends('admin.master')

@section('content')
    <div class="page-container">

        <div class="col-12 d-flex flex-wrap justify-content-between align-items-center my-3">
            <div class="col-8 col-md-8 mb-2 mb-md-0">
                <h4 class="header-title">Edit Receipt</h4>
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
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="text-danger">{{ $error }}</div>
                        @endforeach
                        <br>
                    @endif
                    {{-- Success Message --}}
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <form action="{{ route('admin.receipt.update', ['type' => $type, 'id' => $receipt->id]) }}"
                          method="POST" class="form-horizontal" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            {{-- Name --}}
                            <div class="col-md-4">
                                <label class="col-form-label">Name</label>
                                <input type="text" name="name" class="form-control"
                                       value="{{ old('name', $receipt->name) }}">
                            </div>
                            {{-- Amount --}}
                            <div class="col-md-2">
                                <label class="col-form-label">Amount</label>
                                <input type="number" step="0.01" name="amount" class="form-control"
                                       value="{{ old('amount', $receipt->amount) }}">
                            </div>

                            {{-- Currency --}}
                            <div class="col-md-2">
                                <label class="col-form-label">Currency</label>
                                <select name="currency" class="form-control">
                                    @foreach($currencies as $currency)
                                        <option value="{{ $currency->id }}"
                                            {{ $currency->id === $receipt->currency ? 'selected' : '' }}>
                                            {{ $currency->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>


                            {{-- Payment Type --}}
{{--                            <div class="col-md-4">--}}
{{--                                <label class="col-form-label">Payment Type</label>--}}
{{--                                <select name="pay_type" class="form-control">--}}
{{--                                    @foreach($payTypes as $pType)--}}
{{--                                        <option value="{{ $pType->value }}"--}}
{{--                                            {{ isset($receipt->pay_type) && ($receipt->pay_type->value == $pType->value) ? 'selected' : '' }}>--}}
{{--                                            {{ $pType->label() }}--}}
{{--                                        </option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                            </div>--}}


                            {{-- Payment Type --}}
                            <div class="col-md-4">
                                <label  class="col-form-label ">Payment Type</label>
                                <div class="mt-2">
                                    @foreach($payTypes as $pType)

                                        <input class="form-check-input" id="id_{{$pType->value}}"  {{$pType->value == $payTypes[0]->value ? 'checked' : '' }} type="radio" name="pay_type"
                                               value="{{ $pType->value }}"
                                            {{ isset($receipt->pay_type) && ($receipt->pay_type->value == $pType->value) ? 'checked' : '' }}>
                                        <label for="id_{{$pType->value}}"> {{ $pType->label() }}</label>

                                    @endforeach
                                </div>
                                @error('pay_type')     <div class="text-danger">{{$message}}</div> @enderror

                            </div>







                            {{-- Payment File --}}
                            <div class="col-md-3">
                                <label class="col-form-label">Payment File</label>
                                <input type="file" name="pay_file" class="form-control">
                                @if($receipt->pay_file)
                                    <strong class="text-muted">Current file: <a href="{{asset( $receipt->pay_file )}}"
                                                                                download> <i
                                                class="ri-download-2-fill"></i></a></strong>
                                @endif
                            </div>

                            {{-- Account --}}
                            <div class="col-md-3">
                                <label class="col-form-label">Account</label>
                                <select name="acc_id" class="form-control">
                                    @foreach($accounts as $account)
                                        <option value="{{ $account->accountid }}"
                                            {{ $account->accountid === $receipt->acc_id ? 'selected' : '' }}>
                                            {{ $account->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            {{-- Payment Type --}}
                            <div class="col-md-3">
                                <label class="col-form-label"> acc_details_id</label>
                                <select name="acc_details_id" class="form-control">
                                    <option value="1" {{$receipt->acc_details_id == 1 ? 'selected' : ''}} >
                                        <!--  here  -->
                                        1
                                    </option>
                                </select>
                            </div>


                            <div class="col-md-3">
                                <label class="col-form-label">Rcreated_date </label>
                                <input type="date" name="Rcreated_date" class="form-control"
                                       value="{{ date_create(old('Rcreated_date', $receipt->Rcreated_date))->format('Y-m-d') }}">
                                <!--  here  -->
                            </div>

                            {{-- Notes --}}
                            <div class="col-md-6">
                                <label class="col-form-label">Notes</label>
                                <textarea name="notes" class="form-control"
                                          rows="3">{{ old('notes', $receipt->notes) }}</textarea>
                            </div>











                            {{-- Receipt Type --}}
                            <div class="col-md-6 d-none">
                                <label class="col-form-label">Receipt Type</label>
                                <input type="text" value="{{$receipt->Rtype->value}}" name="Rtype" class="form-control">
{{--                                    @foreach($rTypes as $rtype)--}}
{{--                                        <option value="{{ $rtype->value }}"--}}
{{--                                            {{ $type  && ($receipt->Rtype->value ==  $rtype->value ) ? 'selected' : '' }}--}}
{{--                                        >--}}
{{--                                            {{ $rtype->label() }}--}}
{{--                                        </option>--}}
{{--                                    @endforeach--}}
                             </div>






{{--                             --}}{{-- Payment Type --}}
{{--                            <div class="col-md-6">--}}
{{--                                <label class="col-form-label"> by admin</label>--}}
{{--                                <select name="by_id" class="form-control">--}}
{{--                                    @foreach ($users as $key => $user)--}}
{{--                                        <option--}}
{{--                                            value="{{$user->id}}" {{$receipt->by_id == $user->id ? 'selected' : ''}} >--}}
{{--                                            <!--  here  -->--}}
{{--                                            {{$user->name}}--}}
{{--                                        </option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                            </div>--}}




{{--                            --}}{{-- Approve Note --}}
{{--                            <div class="col-md-6">--}}
{{--                                <label class="col-form-label">Approve Note</label>--}}
{{--                                <textarea name="approve_note" class="form-control"--}}
{{--                                          rows="3">{{ old('approve_note', $receipt->approve_note) }}</textarea>--}}
{{--                            </div>--}}

                            {{-- Approve Checkbox --}}
{{--                            <div class="col-md-2 mt-4">--}}
{{--                                <div class="form-check form-switch">--}}
{{--                                    <input id="approve" class="form-check-input" type="checkbox" name="approve"--}}
{{--                                           value="yes"--}}
{{--                                        {{  ($receipt->approve  === 'yes') ? 'checked' : '' }}>--}}
{{--                                    <label class="form-check-label" for="approve">Approve</label>    <!--  here  -->--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            --}}{{-- posted Checkbox --}}
{{--                            <div class="col-md-2 mt-4">--}}
{{--                                <div class="form-check form-switch">--}}
{{--                                    <input id="posted" class="form-check-input" type="checkbox" name="posted"--}}
{{--                                           value="yes"--}}
{{--                                        {{  ($receipt->posted  === 'yes') ? 'checked' : '' }}>--}}
{{--                                    <label class="form-check-label" for="posted">posted</label>    <!--  here  -->--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            --}}{{-- printed Checkbox --}}
{{--                            <div class="col-md-2 mt-4">--}}
{{--                                <div class="form-check form-switch">--}}
{{--                                    <input id="printed" class="form-check-input" type="checkbox" name="printed"--}}
{{--                                           value="{{true}}"--}}
{{--                                        {{  ($receipt->printed  === true) ? 'checked' : false }}>    <!--  here  -->--}}
{{--                                    <label class="form-check-label" for="printed">printed</label>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-md-6">--}}
{{--                                <label class="col-form-label">acc_detail_type </label>--}}
{{--                                <input type="text" name="acc_detail_type" class="form-control"--}}
{{--                                       value="{{ old('acc_detail_type', $receipt->acc_detail_type) }}">--}}
{{--                                <!--  here  -->--}}
{{--                            </div>--}}

                            {{-- Submit Button --}}
                            <div class="col-12 d-flex justify-content-end mt-4">
                                <button type="submit" class="btn btn-primary rounded-pill px-4">
                                    <i class="ri-save-line"></i> Update Receipt
                                </button>
                            </div>

                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

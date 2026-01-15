@extends('admin.master')
@section('content')
    <div class="page-container">

        <div class="col-12 d-flex flex-wrap justify-content-between align-items-center my-3">
            <div class="col-8 col-md-8 mb-2 mb-md-0">
                <h4 class="header-title">{{__('lang.add_airline')}}</h4>
            </div>
            <div class="col-4 col-md-4 text-center text-md-end">
                <a href="{{ url(route('admin.airlines.index')) }}" class="btn btn-soft-info rounded-pill  float-end"><i class="ri-arrow-go-back-line"></i><span class="d-none d-sm-inline"> &nbsp;&nbsp;{{__('lang.Back')}}   </span></a>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    @if ($errors->any()) @foreach ($errors->all() as $error)
                        <div class="text-danger">{{$error}}</div>
                    @endforeach
                    <br>
                    @endif
                    <form action="{{ url(route('admin.airlines.store')) }}" method="POST" class="form-horizontal"> @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <label for="inpuName3" class="col-3 col-form-label">{{__('lang.name')}}</label>
                                <div class="col-12">
                                    <input type="text" name="name" class="form-control" id="inpuName3"
                                           placeholder="{{__('lang.name')}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="symbol" class=" col-form-label">{{__('lang.symbol')}}</label>
                                <div class="col-12">
                                    <input type="text" name="symbol" class="form-control" id="symbol"
                                           placeholder="{{__('lang.symbol')}}">
                                </div>
                            </div>
{{--                            <div class="col-12 col-md-6">--}}
{{--                                <label for="inpuName3" class="col-form-label">اسم الدخول</label>--}}
{{--                                <input type="text" name="username" value="" class="form-control"/> @error('username')--}}
{{--                                <span class="text-danger">{{ $message }}</span> @enderror--}}
{{--                            </div>--}}
{{--                            <div class="col-md-6">--}}
{{--                                <label for="inputPassword3" class=" col-form-label">{{__('lang.password')}}</label>--}}
{{--                                <div class="col-12">--}}
{{--                                    <input type="password" name="password" autocomplete="new-password"--}}
{{--                                           class="form-control" id="inputPassword3"--}}
{{--                                           placeholder="{{__('lang.password')}}">--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-md-6">--}}
{{--                                <label for="inputPassword5" class="col-12 col-form-label">{{__('lang.role')}}</label>--}}
{{--                                <div class="col-md-12">--}}
{{--                                    <select class="form-control" id="choices-multiple-remove-buttonx" data-choices--}}
{{--                                            data-choices-removeItem name="roles[]">--}}

{{--                                            <option value="">jkjkjkjk</option>  </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}


                            <div
                                class="col-12 col-md-3 offset-md-9 d-flex justify-content-center justify-content-md-end mb-3 mt-3">
                                <button type="submit" class="btn btn-primary rounded-pill px-3">
                                    <i class="ri-user-add-line"></i> &nbsp;&nbsp; {{__('lang.Add')}}
                                </button>
                            </div>
                        </div>
                    </form><!--here end form -->
                </div>
                <!-- end card-body -->
            </div>
        </div>
    </div>
@endsection

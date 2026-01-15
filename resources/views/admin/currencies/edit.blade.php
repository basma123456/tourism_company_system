@extends('admin.master')
@section('content')

    <div class="page-container">
        <div class="col-12 d-flex justify-content-between align-items-center my-3">
            <div class="col-md-8">
                <h4 class="header-title">{{__('lang.currency_edit')}} {{$currency->name}}</h4>
            </div>
            <div class="col-md-4">
                <a href="{{ url(route('admin.currencies.index')) }}"
                   class="btn btn-soft-info rounded-pill px-3 float-end">
                    <i class="ri-arrow-go-back-line"></i>
                    <span class="d-none d-sm-inline">&nbsp;&nbsp; {{__('lang.Back')}}
          <span></span>
        </span>
                </a>
            </div>
        </div>
        <div class="col-lg-12"> @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div> @endif @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div> @endif
            <form action="{{route('admin.currencies.update' , $currency->id)}}" class="card" method="post">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-4">
                            <label for="inpuName3" class="col-form-label">{{__('lang.name')}}</label>
                            <input type="text" name="name" value="{{ $currency->name }}"
                                   class="form-control"/> @error('name') <span
                                class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="symbol" class=" col-form-label">{{__('lang.symbol')}}</label>
                            <input type="text" name="symbol"  id="symbol" value="{{ $currency->symbol }}" class="form-control"/>
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="rate" class="col-form-label">{{__('lang.rate')}}</label>
                            <input type="text"  name="rate"  value="{{ $currency->rate }}"
                                   class="form-control"/>
                        </div>

                    </div>
                 </div>
                <div class="col-12 col-md-3 offset-md-9 d-flex justify-content-center justify-content-md-end mb-3 mt-3">
                    <button type="submit" class="btn btn-primary rounded-pill px-3">
                        <i class="ri-user-add-line"></i> &nbsp;&nbsp; {{__('lang.update')}}
                    </button>
                </div>
                </form>
        </div>
    </div>
    </div> @endsection

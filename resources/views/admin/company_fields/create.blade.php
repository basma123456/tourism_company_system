@extends('admin.master')
@section('content')
    <div class="page-container">

        <div class="col-12 d-flex flex-wrap justify-content-between align-items-center my-3">
            <div class="col-8 col-md-8 mb-2 mb-md-0">
                <h4 class="header-title">{{__('lang.add_client')}}</h4>
            </div>
            <div class="col-4 col-md-4 text-center text-md-end">
                <a href="{{ url(route('admin.company_fields.index')) }}" class="btn btn-soft-info rounded-pill  float-end"><i
                        class="ri-arrow-go-back-line"></i><span
                        class="d-none d-sm-inline"> &nbsp;&nbsp;{{__('lang.Back')}}   </span></a>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

{{--                    @if ($errors->any()) @foreach ($errors->all() as $error)--}}
{{--                        <div class="text-danger">{{$error}}</div>--}}
{{--                    @endforeach--}}
{{--                    <br>--}}
{{--                    @endif--}}
                    <form action="{{ url(route('admin.company_fields.store')) }}" method="POST" class="form-horizontal"> @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <label for="name" class=" col-form-label">{{__('lang.name')}}</label>
                                <div class="col-12">
                                    <input type="text" name="name" class="form-control" id="name"
                                           placeholder="{{__('lang.name')}}">
                                    @error('name') <div class="text-danger">{{$message}}</div> @enderror
                                </div>
                            </div>




                             <div class="col-md-4">
                                <label for="active" class="col-3 col-form-label">{{__('lang.active')}}</label>
                                <div class="col-12">
                                    <input type="checkbox" name="active"   value="1"
                                           id="active"
                                    >
                                    @error('active') <div class="text-danger">{{$message}}</div> @enderror

                                </div>
                            </div>


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

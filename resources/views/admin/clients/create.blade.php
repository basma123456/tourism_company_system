@extends('admin.master')
@section('content')
    <div class="page-container">

        <div class="col-12 d-flex flex-wrap justify-content-between align-items-center my-3">
            <div class="col-8 col-md-8 mb-2 mb-md-0">
                <h4 class="header-title">{{__('lang.add_client')}}</h4>
            </div>
            <div class="col-4 col-md-4 text-center text-md-end">
                <a href="{{ url(route('admin.clients.index')) }}" class="btn btn-soft-info rounded-pill  float-end"><i
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
                    <form action="{{ url(route('admin.clients.store')) }}" method="POST" class="form-horizontal"> @csrf
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
                                <label for="phone" class=" col-form-label">{{__('lang.phone')}}</label>
                                <div class="col-12">
                                    <input type="text" name="phone" class="form-control" id="phone"
                                           placeholder="{{__('lang.phone')}}">
                                   @error('phone') <div class="text-danger">{{$message}}</div> @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label for="email" class="col-3 col-form-label">{{__('lang.email')}}</label>
                                <div class="col-12">
                                    <input type="text" name="email" class="form-control" id="email"
                                           placeholder="{{__('lang.email')}}">
                                    @error('email') <div class="text-danger">{{$message}}</div> @enderror

                                </div>
                            </div>


                            <div class="col-md-4">
                                <label for="address" class="col-3 col-form-label">{{__('lang.address')}}</label>
                                <div class="col-12">
                                    <textarea type="text" name="address"   class="form-control" id="address">{{old('address')}}</textarea>
                                    @error('address') <div class="text-danger">{{$message}}</div> @enderror

                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="person_res" class="col-3 col-form-label">{{__('lang.responsible_person')}}</label>
                                <div class="col-12">
                                    <input type="text" name="person_res" class="form-control" id="person_res"
                                           placeholder="{{__('lang.responsible_person')}}">
                                    @error('person_res') <div class="text-danger">{{$message}}</div> @enderror

                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="ctype" class="col-3 col-form-label">{{__('lang.type')}}</label>
                                <div class="col-12">
                                    <select name="ctype" class="form-control" id="ctype"
                                    >
                                        <option value="">{{__('lang.choose_type')}}</option>
{{--                                        @foreach(\App\Models\Client::get() as $client)--}}
{{--                                            <option value="{{$client->ctype}}">{{$client->ctype->label()}}</option>--}}
{{--                                        @endforeach--}}
                                        @foreach(\App\Enums\ClientTypeEnum::cases() as $client)
                                            <option value="{{$client->value}}">{{$client->label()}}</option>
                                        @endforeach

                                    </select>
                                    @error('ctype') <div class="text-danger">{{$message}}</div> @enderror

                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="active" class="col-3 col-form-label">{{__('lang.active')}}</label>
                                <div class="col-12">
                                    <input type="checkbox" name="active" checked value="1"
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

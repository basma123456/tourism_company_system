@extends('admin.master')
@section('content')
    <div class="page-container">

        <div class="col-12 d-flex flex-wrap justify-content-between align-items-center my-3">
            <div class="col-8 col-md-8 mb-2 mb-md-0">
                <h4 class="header-title">{{__('lang.add_TourismFile')}}</h4>
            </div>
            <div class="col-4 col-md-4 text-center text-md-end">
                <a href="{{ url(route('admin.tourism_files.index')) }}"
                   class="btn btn-soft-info rounded-pill  float-end"><i
                        class="ri-arrow-go-back-line"></i><span
                        class="d-none d-sm-inline"> &nbsp;&nbsp;{{__('lang.Back')}}   </span></a>
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


                    <form action="{{ url(route('admin.tourism_files.store')) }}" method="POST"
                          class="form-horizontal"> @csrf
                        <div class="row">
{{--                            <div class="col-md-4">--}}
{{--                                <label for="Fcode" class=" col-form-label">{{__('lang.Fcode')}}</label>--}}
{{--                                <div class="col-12">--}}
{{--                                    <input type="text" name="Fcode" class="form-control" id="Fcode"--}}
{{--                                           placeholder="{{__('lang.Fcode')}}">--}}
{{--                                    @error('Fcode')--}}
{{--                                    <div class="text-danger">{{$message}}</div> @enderror--}}
{{--                                </div>--}}
{{--                            </div>--}}


                            <div class="col-md-4">
                                <label for="Ftype" class=" col-form-label">{{__('lang.Ftype')}}</label>
                                <div class="col-12">
                                    <select name="Ftype" class="form-control" id="Ftype">
                                        <option value="">...</option>
{{--                                        @foreach( App\Enums\TourismFileTypesEnum::cases() as $item)--}}
{{--                                            <option {{old('Ftype') == $item->value ? 'selected' : '' }} value="{{ $item->value}}">{{$item->label()}}</option>--}}
{{--                                        @endforeach--}}
                                        @foreach( $compayFields as $item)
                                            <option {{old('Ftype') == $item->id ? 'selected' : '' }} value="{{ $item->id}}">{{$item->name}}</option>
                                        @endforeach

                                    </select>
                                    @error('Ftype')
                                    <div class="text-danger">{{$message}}</div> @enderror
                                </div>
                            </div>


                            <div class="col-md-4">
                                <label for="Fname" class=" col-form-label">{{__('lang.Fname')}}</label>
                                <div class="col-12">
                                    <input type="text" name="Fname" class="form-control"  value="{{old('Fname')}}" id="Fname"
                                           placeholder="{{__('lang.Fname')}}">
                                    @error('Fname')
                                    <div class="text-danger">{{$message}}</div> @enderror
                                </div>
                            </div>


                            <div class="col-md-4">
                                <label for="emp" class=" col-form-label">{{__('lang.emp')}}</label>
                                <div class="col-12">
                                    <select type="text" name="emp" class="form-control select2" id="emp"  data-toggle="select2"
                                            placeholder="{{__('lang.emp')}}">
                                        <option value="">...</option>
                                        @foreach($clients as $item)
                                            <option {{old('emp') == $item->id ? 'selected' : ''}} value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach

                                    </select>
                                    @error('emp')
                                    <div class="text-danger">{{$message}}</div> @enderror
                                </div>
                            </div>


                            <div class="col-md-4">
                                <label for="adults_no" class=" col-form-label">{{__('lang.adults_no')}}</label>
                                <div class="col-12">
                                    <input type="text" name="adults_no" value="{{old('adults_no')}}" class="form-control" id="adults_no"
                                           placeholder="{{__('lang.adults_no')}}">
                                    @error('adults_no')
                                    <div class="text-danger">{{$message}}</div> @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label for="child_no" class=" col-form-label">{{__('lang.child_no')}}</label>
                                <div class="col-12">
                                    <input type="text" value="{{old('child_no')}}" name="child_no" class="form-control" id="child_no"
                                           placeholder="{{__('lang.child_no')}}">
                                    @error('child_no')
                                    <div class="text-danger">{{$message}}</div> @enderror
                                </div>
                            </div>


                            <div class="col-md-4">
                                <label for="infants_no" class=" col-form-label">{{__('lang.infants_no')}}</label>
                                <div class="col-12">
                                    <input type="text"  value="{{old('infants_no')}}" name="infants_no" class="form-control" id="infants_no"
                                           placeholder="{{__('lang.infants_no')}}">
                                    @error('infants_no')
                                    <div class="text-danger">{{$message}}</div> @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="arrival_date" class=" col-form-label">{{__('lang.arrival_date')}}</label>
                                <div class="col-12">
                                    <input type="date" value="{{old('arrival_date')}}" name="arrival_date" class="form-control" id="arrival_date"
                                           placeholder="{{__('lang.arrival_date')}}">
                                    @error('arrival_date')
                                    <div class="text-danger">{{$message}}</div> @enderror
                                </div>
                            </div>


                            <div class="col-md-4">
                                <label for="leave_date" class=" col-form-label">{{__('lang.leave_date')}}</label>
                                <div class="col-12">
                                    <input type="date"  value="{{old('leave_date')}}" name="leave_date" class="form-control" id="leave_date"
                                           placeholder="{{__('lang.leave_date')}}">
                                    @error('leave_date')
                                    <div class="text-danger">{{$message}}</div> @enderror
                                </div>
                            </div>



                            <div class="col-md-4">
                                <label for="nationality" class=" col-form-label">{{__('lang.nationality')}}</label>
                                <div class="col-12">
                                    <select  name="nationality" class="form-control select2" data-toggle="select2" id="nationality"
                                             placeholder="{{__('lang.nationality')}}">
                                        <option value="">...</option>
                                        @foreach($countries as $item)
                                            <option {{ old('nationality') == $item->id ? 'selected' : ''}} value="{{$item->id}}">{{$item->$country_name}}</option>
                                        @endforeach

                                    </select>
                                    @error('nationality')
                                    <div class="text-danger">{{$message}}</div> @enderror
                                </div>
                            </div>



                            <div class="col-md-4">
                                <label for="created_date" class=" col-form-label">{{__('lang.created_date')}}</label>
                                <div class="col-12">
                                    <input type="date" value="{{old('created_date')}}" name="created_date" class="form-control" id="created_date"
                                           placeholder="{{__('lang.created_date')}}">
                                    @error('created_date')
                                    <div class="text-danger">{{$message}}</div> @enderror
                                </div>
                            </div>


                            <div class="col-md-3">

                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <div class="form-check form-switch  ">

                                            <label class="form-check-label" for="closed">{{__('lang.closed')}}</label>
                                            <input id="closed" class="form-check-input" type="checkbox" value="1"
                                                   name="closed"
                                                {{old('closed') == 1 ? 'checked' : '' }}>
                                            @error('closed')
                                            <div class="text-danger">{{$message}}</div> @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-check form-switch  ">
                                            <label class="form-check-label"
                                                   for="approved">{{__('lang.approved')}}</label>
                                            <input class="form-check-input" id="approved" type="checkbox" value="1"
                                                   name="approved"
                                                {{old('approved') == 1 ? 'checked' : '' }}>
                                            @error('approved')
                                            <div class="text-danger">{{$message}}</div> @enderror

                                        </div>
                                    </div>
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

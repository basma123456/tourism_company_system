@extends('admin.master')
@section('content')

    <div class="page-container">

        <div class="col-12 d-flex justify-content-between align-items-center my-3">
            <div class="col-md-8">
                <h4 class="header-title">{{__('lang.TourismFile_edit')}} {{$tourismFile->Fname}}</h4>
            </div>


            <div class="col-md-4">
                <a href="{{ url(route('admin.tourism_files.index')) }}"
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


            @if ($errors->any()) @foreach ($errors->all() as $error)
                <div class="text-danger">{{$error}}</div>
            @endforeach
            <br>
            @endif

            <form action="{{route('admin.tourism_files.update' , $tourismFile->id)}}" class="card" method="post">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row">


                        <div class="col-12 col-md-4">
                            <label for="Ftype" class=" col-form-label">{{__('lang.Ftype')}}</label>
                            <select name="Ftype" class="form-control" id="Ftype">
                                <option value="">...</option>
{{--                                @foreach( App\Enums\TourismFileTypesEnum::cases() as $item)--}}
{{--                                    <option   {{ $tourismFile->Ftype->value  == $item->value ? 'selected' : '' }} value="{{ $item->value}}">{{$item->label()}} </option>--}}
{{--                                @endforeach--}}
                                @foreach( $companyFields as $item)
                                    <option   {{ $tourismFile->Ftype  == $item->id ? 'selected' : '' }} value="{{ $item->id}}">{{$item->name}} </option>
                                @endforeach

                            </select>
                            @error('Ftype')
                            <div class="text-danger">{{$message}}</div> @enderror
                        </div>



                        <div class="col-12 col-md-4">
                            <label for="Fname" class="col-form-label">{{__('lang.Fname')}}</label>
                            <input type="text" name="Fname" value="{{ $tourismFile->Fname }}"
                                   class="form-control"/> @error('Fname') <span
                                class="text-danger">{{ $message }}</span> @enderror
                        </div>



                        <div class="col-12 col-md-4">
                            <label for="emp" class=" col-form-label">{{__('lang.emp')}}</label>
                            <select name="emp" class="form-control select2" id="emp" data-toggle="select2">
                                <option value="">...</option>
                                @foreach( $clients as $item)
                                    <option   {{ $tourismFile->emp  == $item->id ? 'selected' : '' }} value="{{ $item->id}}">{{$item->name }}</option>
                                @endforeach
                            </select>
                            @error('emp')
                            <div class="text-danger">{{$message}}</div> @enderror
                        </div>



                        <div class="col-12 col-md-4">
                            <label for="adults_no" class="col-form-label">{{__('lang.adults_no')}}</label>
                            <input type="number" name="adults_no" value="{{ $tourismFile->adults_no }}"
                                   class="form-control"/> @error('adults_no') <span
                                class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="child_no" class="col-form-label">{{__('lang.child_no')}}</label>
                            <input type="number" name="child_no" value="{{ $tourismFile->child_no }}"
                                   class="form-control"/> @error('child_no') <span
                                class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="infants_no" class="col-form-label">{{__('lang.infants_no')}}</label>
                            <input type="number" name="infants_no" value="{{ $tourismFile->infants_no }}"
                                   class="form-control"/> @error('infants_no') <span
                                class="text-danger">{{ $message }}</span> @enderror
                        </div>


                        <div class="col-12 col-md-4">
                            <label for="arrival_date" class="col-form-label">{{__('lang.arrival_date')}}</label>
                            <input type="date" name="arrival_date" value="{{ $tourismFile->arrival_date_only  }}"
                                   class="form-control"/> @error('arrival_date') <span
                                class="text-danger">{{ $message }}</span> @enderror
                        </div>


                        <div class="col-12 col-md-4">
                            <label for="leave_date" class="col-form-label">{{__('lang.leave_date')}}</label>
                            <input type="date" name="leave_date" value="{{ $tourismFile->leave_date_only   }}"
                                   class="form-control"/> @error('leave_date') <span
                                class="text-danger">{{ $message }}</span> @enderror
                        </div>


                        <div class="col-md-4">
                            <label for="nationality" class=" col-form-label">{{__('lang.nationality')}}</label>
                            <div class="col-12">
                                <select  name="nationality" class="form-control select2" data-toggle="select2" id="nationality"
                                        placeholder="{{__('lang.nationality')}}">
                                    <option value="">...</option>
                                    @foreach($countries as $item)
                                        <option {{$tourismFile->nationality === $item->id ? 'selected' : ''}} value="{{$item->id}}">{{$item->$country_name}}</option>
                                    @endforeach

                                </select>
                                @error('nationality')
                                <div class="text-danger">{{$message}}</div> @enderror
                            </div>
                        </div>


                        <div class="col-12 col-md-4">
                            <label for="created_date" class="col-form-label">{{__('lang.created_date')}}</label>
                            <input type="date" name="created_date" value="{{  $tourismFile->created_date_only  }}"
                                   class="form-control"/> @error('created_date') <span
                                class="text-danger">{{ $message }}</span> @enderror
                        </div>















                        <div class="col-md-4">
                            <label for="closed" class="col-form-label">{{__('lang.closed')}}</label>
                                <input type="checkbox" name="closed" {{$tourismFile->closed == 1 ? 'checked' : ''}} value="1"
                                       id="closed"
                                >
                                @error('closed') <div class="text-danger">{{$message}}</div> @enderror

                        </div>


                        <div class="col-md-4">
                            <label for="approved" class="col-form-label">{{__('lang.approved')}}</label>
                            <input type="checkbox" name="approved" {{$tourismFile->approved == 1 ? 'checked' : ''}} value="1"
                                   id="approved"
                            >
                            @error('approved') <div class="text-danger">{{$message}}</div> @enderror

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

@extends('admin.master')
@section('content')

    <div class="page-container">

        <div class="col-12 d-flex justify-content-between align-items-center my-3">
            <div class="col-md-8">
                <h4 class="header-title">{{__('lang.currency_edit')}} {{$client->name}}</h4>
            </div>


            <div class="col-md-4">
                <a href="{{ url(route('admin.clients.index')) }}"
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

            <form action="{{route('admin.clients.update' , $client->id)}}" class="card" method="post">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-4">
                            <label for="inpuName3" class="col-form-label">{{__('lang.name')}}</label>
                            <input type="text" name="name" value="{{ $client->name }}"
                                   class="form-control"/> @error('name') <span
                                class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="phone" class="col-form-label">{{__('lang.phone')}}</label>
                            <input type="text" name="phone" value="{{ $client->phone }}"
                                   class="form-control"/> @error('phone') <span
                                class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="email" class="col-form-label">{{__('lang.email')}}</label>
                            <input type="email" name="email" value="{{ $client->email }}"
                                   class="form-control"/> @error('email') <span
                                class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="address" class="col-form-label">{{__('lang.address')}}</label>
                            <input type="text" name="address" value="{{ $client->address }}"
                                   class="form-control"/> @error('address') <span
                                class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="person_res" class="col-form-label">{{__('lang.responsible_person')}}</label>
                            <input type="text" name="person_res" value="{{ $client->person_res }}"
                                   class="form-control"/> @error('person_res') <span
                                class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="col-12 col-md-4">
                            <label for="ctype" class="col-form-label">{{__('lang.type')}}</label>
                            <select type="text" name="ctype" value="{{ $client->ctype }}"
                                    class="form-control" >
                        <option value="">{{__('lang.choose_type')}}</option>
                                @foreach(App\Enums\ClientTypeEnum::cases() as $type)
                                    <option value="{{$type->value}}" {{ $type->value  == $client->ctype->value ? 'selected' : ''}}>{{$type->label()}}</option>
                                    @endforeach
                            </select>
                        </div>


                            @error('ctype') <span
                                class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="active" class="col-form-label">{{__('lang.active')}}</label>
                                <input type="checkbox" name="active" {{$client->active == 1 ? 'checked' : ''}} value="1"
                                       id="active"
                                >
                                @error('active') <div class="text-danger">{{$message}}</div> @enderror

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

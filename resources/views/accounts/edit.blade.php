@extends('admin.master')

@section('content')
    <div class="page-container">
        <div class="row">

            <div class="col-xl-12 m-auto">
                <div class="card m-auto">
                    <div class="card-header border-bottom border-dashed d-flex align-items-center"
                         style="  justify-content: space-between;">
                        <h4 class="header-title">شجرة الحسابات </h4>
                        <div class=" float-end">
                            <a href="{{ url(route('admin.acc_index')) }}"
                               class="btn btn-soft-info rounded-pill   float-end  ">رجوع</a>


                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ url(route('admin.acc_update',$account->accountid)) }}" method="POST"
                              class="form-horizontal " novalidate
                              enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                            @if (session('success'))
                                <!-- <div class="alert alert-success">{{ session('success') }}</div> -->
{{--                                @include('admin.success_sweet_alert', ['title'=>session('success')])--}}
                                    <div class="alert alert-success"> {{session('success')}} </div>
                            @endif

                            @if (session('error'))
                                <!-- <div class="alert alert-danger">{{ session('error') }}</div> -->
                                    @include('admin.error_sweet_alert', ['title'=>session('error')])
                                @endif
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="simpleinput" class="form-label"> فرعي من</label>
                                        <select class="form-select" id="example-select" name="parent_id">
                                            <option value="">اختر</option>
                                            @if(!empty($data)  )
                                                @foreach ($data as $key => $acc)
                                                    @if(!$acc->parent_id)
                                                        <option
                                                            value="{{ $acc->accountid }}" {{$account->parent_id == $acc->accountid ? 'selected' : '' }} >{{ $acc->code }} {{ $acc->name }} </option>


                                                        @if(  !empty($acc->children  ))
                                                        <!-- second level -->
                                                            @foreach ($acc->children  as $key => $third)
                                                                <option
                                                                    value="{{ $third->accountid }}" {{$account->parent_id == $third->accountid ? 'selected' : '' }} >
                                                                    ... {{ $third->code }} {{ $third->name }}</option>
                                                                <!-- forth level -->
                                                                @foreach ($third->children  as $key => $forth)
                                                                    <option
                                                                        value="{{ $forth->accountid }}" {{$account->parent_id == $forth->accountid ? 'selected' : '' }}>
                                                                        ...
                                                                        ... {{ $forth->code }} {{ $forth->name }}</option>
                                                                @endforeach
                                                            <!-- forth level -->
                                                            @endforeach
                                                        <!-- second level -->
                                                        @endif

                                                    @endif
                                                @endforeach
                                            @endif
                                        </select>
                                        @error('parent_id')
                                        <div class="invalid-feedback"> {{$message}}    </div>@enderror
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="mb-3">
                                        <label for="simpleinput" class="form-label">الكود</label>
                                        <input type="text" id="simpleinput" name="code" value="{{$account->code}}"
                                               class="form-control @error('code') is-invalid @enderror">
                                        @error('code')
                                        <div class="invalid-feedback"> {{$message}}    </div>@enderror
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="simpleinput" class="form-label">الأسم</label>
                                        <input type="text" id="simpleinput" name="name" value="{{$account->name}}"
                                               class="form-control @error('name') is-invalid @enderror">
                                        @error('name')
                                        <div class="invalid-feedback"> {{$message}}    </div>@enderror
                                    </div>
                                </div>


                            </div>


                            <div class="col-6">
                                <div class="mb-2 mt-3">
                                    <button type="submit" class="btn btn-primary mt-3 mt-md-0">حفظ</button>
                                </div>
                            </div>


                    </div>

                    </from>


                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
    </div>
@endsection
@section('scripts')

    <script type="text/javascript">
        /***********************start visitors**********/
        {{--var path = "{{ route('admin.autocomplete' , 'visitors') }}";--}}
        {{--$('#visitor_id').select2({--}}
        {{--    placeholder: 'Select a visitor',--}}
        {{--    ajax: {--}}
        {{--        url: path,--}}
        {{--        dataType: 'json',--}}
        {{--        delay: 250,--}}
        {{--        processResults: function (data) {--}}
        {{--            return {--}}
        {{--                results: $.map(data, function (item) {--}}
        {{--                    return {--}}
        {{--                        text: item.name + " : " + item.destination_type,--}}
        {{--                        id: item.id--}}
        {{--                    }--}}
        {{--                })--}}
        {{--            };--}}
        {{--        },--}}
        {{--        cache: true--}}
        {{--    }--}}
        {{--});--}}
        /***********************end visitors*************/


    </script>
@endsection


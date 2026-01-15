@extends('admin.master')

@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.6.0/css/all.min.css">

    <div class="page-container my-4">
        {{-- Success Message --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <div class="col-12 d-flex flex-wrap justify-content-between align-items-center my-3">
            <div class="col-12 col-md-8 mb-2 mb-md-0">
                <h4 class="header-title">{{__('lang.clients')}}</h4>
            </div>
            <div class="col-12 col-md-4 text-md-end text-center">


                <div class="">

                <a class="badge badge-outline-primary" href="{{url(route('admin.clients.create'))}}">
                                {{__('lang.add_new')}} </a>


                    {{--/**********excel btn**********/--}}
                    <span title="اكسيل" onclick="exportDivToExcel('pr', 'final_report.xlsx')"
                          target="_blank"
                          class="btn btn-sm btn-success  ">
                        <i class="ri-file-excel-line"></i>
                    </span>

                    {{--/*********excel brn**********/--}}

                    <span title="طباعة" onclick="printDiv('pr')" class="btn btn-sm btn-danger  ">
                            <i class="ri-printer-line"></i>
                        </span>

                </div>

            </div>
        </div>


        {{-- Filter Form Section --}}
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body">

                <div class="card bg-search">
                    <form action="{{route('admin.clients.index')}}" method="get" class="card-body pb-3" >
                        @csrf
                        <div class="row ">



                            {{-- Search Input --}}
                            <div class="col-md-3">
                                <input class="form-control" type="text" name="search"
                                       placeholder="الاسم / المعدل / اارمز" value="{{request()->get('search')}}">
                            </div>



                            {{-- Action Buttons --}}
                            <div class="col-md-3">
                                <div class="d-flex gap-2 ">
                                    <button type="submit" class="btn btn-success">
                                        <i class="ri-search-line me-1"></i>بحث
                                    </button>
                                    <a href="{{url(route('admin.clients.index'))}}"
                                       class="btn btn-primary"> <i class="ri-arrow-go-back-line me-1"></i>إعادة تعيين
                                    </a>

                                </div>
                            </div>


                            {{-- Search + Gender + Active on one row --}}

                        </div>


                    </form>

                </div>


            </div>
        </div>


        {{-- Filtered Data --}}
        <div class="card shadow-sm border-0">
            <div class="card-body">

                <div class="card border-success mb-3 rounded-3 overflow-hidden">

                    <div class="card-body">
                        {{-- Success Message --}}
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif


                        <hr>

                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>{{__('lang.code')}}</th>
                                <th>{{__('lang.name')}}</th>
                                <th>{{__('lang.phone')}}</th>
                                <th>{{__('lang.email')}}</th>
                                <th>{{__('lang.address')}}</th>
                                <th>{{__('lang.active')}}</th>
                                <th>{{__('lang.person_res')}}</th>
                                <th>{{__('lang.ctype')}}</th>
                                <th>{{__('lang.actions')}}</th>

                            </tr>
                            </thead>
                            <tbody>

                            @forelse($clients as $item)
                                <tr>
                                    <td>{{$item->code}}</td>
                                    <td> {{$item->name}}</td>
                                    <td>{{$item->phone}}</td>
                                    <td>{{$item->email}}</td>
                                    <td>{{$item->address}}</td>
                                    <td>@if($item->active == 1) <i class="fa fa-check text-success" ></i> @else  <i class="fa fa-minus text-secondary" ></i>   @endif</td>
                                    <td>{{$item->person_res}}</td>
                                    <td>{{$item->ctype->label()}}</td>


                                    <td class="td_actions">                       @if(checkModulePermission('admins', 'edit'))
                                            <a href="{{url(route('admin.clients.edit' , $item->id))}}"
                                               class="btn btn-soft-success btn-icon btn-sm rounded-circle mx-1">
                                                <i class="ri-edit-box-line fs-16"></i>
                                            </a>
                                        @endif
                                        @if(checkModulePermission('admins', 'delete'))
                                            <form action="{{route('admin.clients.destroy' , $item->id)}}" method="post"
                                            >
                                                @csrf
                                                @method('DELETE')
                                            <div class="btn btn-soft-success btn-icon btn-sm rounded-circle"  onclick="confirmDeletion(this)"> <i class="ri-delete-bin-line fs-16"></i></div>

                    </form>
                                        @endif </td>
                                </tr>
                            @empty

                            @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

            <div class="mt-4 d-flex justify-content-center">
                {{--  <!--{{ $members->appends(request()->query())->links() }}-->   --}}
            </div>

        </div>
    </div>
    </div>
    <style>
        .documents {
            flex-shrink: 0;
            /* Prevent shrinking */
        }

        .documents .btn {
            font-size: 0.875rem;
            font-weight: 500;
            border-radius: 6px;
            transition: all 0.2s ease-in-out;
            white-space: nowrap;
        }

        .documents .btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }

        .documents .btn i {
            font-size: 1rem;
        }


        @media (max-width: 768px) {
            .d-flex.justify-content-between.align-items-center {
                flex-direction: column;
                align-items: flex-start !important;
                gap: 1rem;
            }

            .documents {
                width: 100%;
                justify-content: flex-end;
            }

            .documents .btn {
                flex: 1;
                justify-content: center;
            }
        }

        .icon-btn {
            background: none;
            border: none;
            padding: 0;
            font-size: 1.2rem;
            cursor: pointer;
        }

        .icon-btn:hover {
            opacity: 0.8;
        }
    </style>


    <script>
        function printDiv(divId) {
            const content = document.getElementById(divId).innerHTML;
            const printWindow = window.open('', '', 'height=600,width=800');
            printWindow.document.write('<html><head><title>Print</title>');
            printWindow.document.write("<style> .hide_print{display:none !important;}@page { size: auto;  margin: 5mm; }.hide_print{display:none !important}.show_print{display:block !important}@if(app()->getLocale()=='ar') body{font-family:'Amiri',sans-serif;direction:rtl!important;text-align:right}@else body{font-family:sans-serif;direction:ltr!important;text-align:left}@endif table,td,th{border:1px solid}table{width:100%;border-collapse:collapse}h2{text-align:left}table{font-family:arial,sans-serif;border-collapse:collapse;direction:rtl;width:100%;color:#000}td,th{text-align:center;padding:5px;font-size:12px}th{background-color:#af9c60;background-color:rgb(175 156 96 / .1);padding:10px}tr:nth-child(even){background-color:#F8F9FB}.content-container_table{padding:5px 0;font-family:DejaVu Sans,sans-serif;height:auto;margin:auto;font-weight:700;border:2px solid lightgray!important;border-right:none!important;border-left:none!important}.content-left,.content-middle,.content-right{display:inline-block!important;vertical-align:top;margin-top:0}.content-middle{width:100px;padding:0 4px;clear:both;background-color:red;flex-wrap:wrap}.content-middle img{margin:auto;text-align:center}.content-left h6,.content-right h6{color:#998048;font-weight:700;margin:8px 0;text-transform:uppercase}.content-left h5,.content-right h5{font-weight:700;margin:8px 0;text-transform:capitalize}.content-left small,.content-right small{font-weight:400;margin:6px 0}.bottom-border{border-bottom:1px solid lightgrey}.last_td{border-bottom:1px solid lightgrey;border-top:1px solid lightgrey}.redTest{color:red}.right{text-align:right;margin-top:0!important}.left{text-align:left;margin-top:0!important}.logo{display:block;text-align:center;margin:auto;max-width:200px}.left-col,.right-col,.middle-col{width:32%!important}.left-col{text-align:left!important}.right-col{text-align:right!important}.td_header{width:32%}.th_header{width:32%}.middle_bottom_td{width:65%}h3{font-weight:bold!important;color:#B8741A}.outer_div_right{text-align:right;font-size:70%;width:100%}.outer_div_left{text-align:left;font-size:70%;width:100%}.inner_span{font-weight:bold!important;color:#134356;font-size:120%;display:block;margin-bottom:7px}.upper_tr{padding-bottom:8px;padding-top:8px;background:none!important;text-align:center!important;color:rgb(0 0 0 / .8)}.date_tr{text-align:left}.span_tr{color:#c00;font-weight:bold!important}.date_tr{float:right}.wrapper{padding-left:20px;padding-right:20px}.table_card{font-size:70%!important}.header-title{text-align:center}.header-title{margin-top:10px!important}</style><style>@if(app()->getLocale()=='ar') body{font-family:'Amiri',sans-serif;direction:rtl!important;text-align:right}@else body{font-family:sans-serif;direction:ltr!important;text-align:left}@endif table,td,th{border:1px solid}table{width:100%;border-collapse:collapse}h2{text-align:left}table{font-family:arial,sans-serif;border-collapse:collapse;direction:rtl;width:100%;color:#000}td,th{text-align:center;padding:12px}th{background-color:#af9c60;background-color:rgb(175 156 96 / .1);padding:10px}tr:nth-child(even){background-color:#F8F9FB}.content-container_table{padding:5px 0;font-family:DejaVu Sans,sans-serif;height:auto;margin:auto;font-weight:700;border:2px solid lightgray!important;border-right:none!important;border-left:none!important}.content-left,.content-middle,.content-right{display:inline-block!important;vertical-align:top;margin-top:0}.content-middle{width:100px;padding:0 4px;clear:both;background-color:red;flex-wrap:wrap}.content-middle img{margin:auto;text-align:center}.content-left h6,.content-right h6{color:#998048;font-weight:700;margin:8px 0;text-transform:uppercase}.content-left h5,.content-right h5{font-weight:700;margin:8px 0;text-transform:capitalize}.content-left small,.content-right small{font-weight:400;margin:6px 0}.bottom-border{border-bottom:1px solid lightgrey}.last_td{border-bottom:1px solid lightgrey;border-top:1px solid lightgrey}.redTest{color:red}.right{text-align:right;margin-top:0!important}.left{text-align:left;margin-top:0!important}.logo{display:block;text-align:center;margin:auto;max-width:200px}.left-col,.right-col,.middle-col{width:32%!important}.left-col{text-align:left!important}.right-col{text-align:right!important}.td_header{width:32%}.th_header{width:32%}.middle_bottom_td{width:65%}h3{font-weight:bold!important;color:#B8741A}.outer_div_right{text-align:right;font-size:70%;width:100%}.outer_div_left{text-align:left;font-size:70%;width:100%}.inner_span{font-weight:bold!important;color:#134356;font-size:120%;display:block;margin-bottom:7px}.upper_tr{padding-bottom:8px;padding-top:8px;background:none!important;text-align:center!important;color:rgb(0 0 0 / .8)}.date_tr{text-align:left}.span_tr{color:#c00;font-weight:bold!important}.date_tr{float:right}.wrapper{padding-left:20px;padding-right:20px}.table_card{font-size:70%!important}.header-title{text-align:center}.header-title{margin-top:10px!important}.table td th{border: 1px solid #ccc !important;} th{background:#cccccc69 !important; -webkit-print-color-adjust: exact !important;} h4,h3,h2,h1,h5 {text-align:right;}</style>");
            printWindow.document.write('</head><body>');
            printWindow.document.write(content);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        }






        function confirmDeletion(obj){
            const form = obj.parentNode;
            if (!confirm('Are you sure you want to delete this item?')) {
                return;
            }

          return   form.submit();
        }

    </script>



 @endsection

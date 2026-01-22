@extends('admin.master')

@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.6.0/css/all.min.css">

    <div class="page-container my-4">


        <div class="col-12 d-flex flex-wrap justify-content-between align-items-center my-3">
            <div class="col-12 col-md-8 mb-2 mb-md-0">
                <h4 class="header-title">{{__('lang.receipts') . " " .__('lang.receipt_' . $type)}}</h4>
            </div>
            <div class="col-12 col-md-4 text-md-end text-center">


                <div class="">

                    <a class="badge badge-outline-primary"
                       href="{{url(route('admin.receipt.create' , ['type' =>$type]))}}">
                        {{__('lang.add_new')}} </a>


                    {{--/**********excel btn**********/--}}
                    <span title="اكسيل" onclick="getDataExcel('{{url('/admin/receipts_all/' . $type)}}' , 'receipts.xlsx')"
                          target="_blank"
                          class="btn btn-sm btn-success  ">
                        <i class="ri-file-excel-line"></i>
                    </span>

                    {{--/*********excel brn**********/--}}

                    <span title="طباعة" onclick="getDataPrint('{{url('/admin/receipts_all/' . $type)}}' )"
                          class="btn btn-sm btn-danger  ">
                            <i class="ri-printer-line"></i>
                        </span>

                </div>

            </div>
        </div>


        {{-- Filter Form Section --}}
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body">

                <div class="card bg-search">

                    <form action="#" method="get" class="card-body pb-3">
                        @csrf
                        <div class="row ">


                            {{-- Search Input --}}
                            <div class="col-md-3">
                                <input class="form-control" type="text" name="search"
                                       placeholder="الاسم / الكود / اارمز" value="{{request()->get('search')}}">
                            </div>


                            {{-- Action Buttons --}}
                            <div class="col-md-3">
                                <div class="d-flex gap-2 ">
                                    <button type="submit" class="btn btn-success">
                                        <i class="ri-search-line me-1"></i>بحث
                                    </button>
                                    <a href="{{url(route('admin.receipt.index' , ['type' => $type]))}}"
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
        {{--        <h2><a href="{{route('admin.receipt.show' , ['type' => $type , 'id' => 1])}}">uyuyu</a></h2>--}}


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
                                <th> #</th>
                                <th> name</th>
                                <th>amount</th>
                                <th>acc_id</th>
                                <th>acc_details_id</th>
                                <th>notes</th>
                                <th>Rcreated_date</th>
                                <th>by_id</th>


                                {{--                                <th>Rtype</th>--}}
                                {{--                                <th>currency</th>--}}
                                {{--                                <th>pay_type</th>--}}
                                {{--                                <th>pay_file</th>--}}
                                {{--                                <th>acc_detail_type</th>--}}
                                {{--                                <th> approve</th>--}}
                                {{--                                <th>printed</th>--}}
                                {{--                                <th>posted</th>--}}

                                <th> التحكم</th>

                            </tr>
                            </thead>
                            <tbody>


                            @forelse($receipts as $item)

                                <tr>
                                    <td>{{$item->id??'-----'}}</td>

                                    <td>{{$item->name??'-----'}}</td>
                                    <td class=" fw-bold"> {{$item->amount . "     "  ??'-----'}} <span
                                            class='text-primary'>   {{  $item->currencyRelation->symbol }}    </span>
                                    </td>
                                    <td>{{$item->account->name??'-----'}}</td>
                                    <td>{{$item->acc_details_id??'-----'}}</td>
                                    <td>{{$item->notes??'-----'}}</td>
                                    <td>{{$item->date??'-----'}}</td>
                                    <td> {{$item->user->name??'-----'}}</td>


                                    {{--                                    <td>{{$item->Rtype->label()??'-----'}}</td>--}}
                                    {{--                                    <td>{{$item->currency->name??'-----'}}</td>--}}
                                    {{--                                    <td> {{$item->pay_type->label()??'-----'}}</td>--}}
                                    {{--                                    <td>@if($item->pay_file)<a download href="{{asset($item->pay_file)}}"   class="btn text-primary"><i class="ri-download-2-fill fs-16"></i></a>@endif</td>--}}
                                    {{--                                    <td> {{$item->acc_detail_type??'-----'}}</td>--}}
                                    {{--                                    <td>{{$item->approve??'-----'}}</td>--}}
                                    {{--                                    <td> {{ $item->printed   ? __('lang.yes') :__('lang.no')}}</td>--}}
                                    {{--                                    <td>{{$item->posted??'-----'}}</td>--}}
                                    {{--                                    <td>{{$item->date??'-----'}}</td>--}}


                                    <td class="td_actions">
                                        @if($item->pay_file)<a download href="{{asset($item->pay_file)}}"
                                                               title="{{__('lang.download_attachment')}}"
                                                               class="btn btn-soft-success btn-icon btn-sm rounded-circle "><i
                                                class="ri-download-2-fill fs-16"></i></a>@endif
                                        @if(checkModulePermission('admins', 'edit'))
                                            <a href="{{url(route('admin.receipt.edit' , ['type' =>$type   , 'id' => $item->id]))}}"
                                               title="{{__('lang.edit')}}"
                                               class="btn btn-soft-success btn-icon btn-sm rounded-circle mx-1">
                                                <i class="ri-edit-box-line fs-16"></i>
                                            </a>
                                        @endif
                                        @if(checkModulePermission('admins', 'view'))
                                            <a onclick="printDiv('pr_{{$item->id}}')"
                                               title="{{__('lang.print')}}"
                                               class="btn btn-soft-success btn-icon btn-sm rounded-circle mx-1">
                                                <i class="ri-printer-line fs-16"></i>
                                            </a>
                                        @endif

                                        @if(checkModulePermission('admins', 'delete'))
                                            <form
                                                action="{{route('admin.receipt.destroy' , ['type' =>$type   , 'id' => $item])}}"
                                                method="post"
                                            >
                                                @csrf
                                                @method('DELETE')
                                                <div title="{{__('lang.delete')}}"
                                                     class="btn btn-soft-success btn-icon btn-sm rounded-circle"
                                                     onclick="confirmDeletion(this)"><i
                                                        class="ri-delete-bin-line fs-16"></i></div>

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



            <!-------------------------- print for each item -->
            @foreach($receipts as $item)
                <div id="pr_{{$item->id}}" style="display: none  ">
                    @include('admin/receipts/print_item' , ['receipt' => $item , 'type' => $item->Rtype->value  , 'settings' => all_settings()->getSiteSetting()])
                </div>
            @endforeach
            <!-------------------------- end print for each item -->



            <div class="mt-4 d-flex justify-content-center">
                {{count($receipts) ? $receipts->links() : ''}}
                {{--  <!--{{ $members->appends(request()->query())->links() }}-->   --}}
            </div>
            <!---------------------start print all grid ------------>
            <div id="pr" style="display: none">
                @include('admin.receipts.print', ['receipts'=>@$receipts])
            </div>
            <!-----end all grid ------------->

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


        function confirmDeletion(obj) {
            const form = obj.parentNode;
            if (!confirm('Are you sure you want to delete this item?')) {
                return;
            }

            return form.submit();
        }

    </script>



@endsection

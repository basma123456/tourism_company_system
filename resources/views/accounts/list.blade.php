@extends('admin.master')

@section('content')

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <div>{{$error}}</div>
        @endforeach
    @endif


    <!-------start ----------->
    <div class="page-container">

        <div class="row">

            <div class="col-12">

                <div class="card">
                    <div class="card-header border-bottom border-dashed d-flex align-items-center"
                         style="  justify-content: space-between;">
                        <h4 class="header-title">{{__('lang.tree_accounts')}}</h4>
                        <div class=" float-end">
                            @if(checkModulePermission('accounts', 'add'))
                                <a href="{{ url(route('admin.acc_create')) }}"
                                   class="btn btn-soft-info rounded-pill   float-end  ">اضافة جديد</a>   @endif


                            <button onclick="CallPrintdiv('pr')" type="button" class="btn btn-primary  mt-md-0"><i
                                    class="ri-printer-line"></i> طباعة
                            </button>

                        </div>
                    </div>


                    <div class="card-body">


                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        {{--     @if (session('success'))
                              @include('admin.success_sweet_alert', ['title'=>session('success')])
                            @endif --}}


                        <div class="table-responsive-sm" style="" id="pr">
                            <table

                                class="table table-bordered mb-0">
                                <thead class="bg-soft-primary">
                                <tr>

                                    <th>الكود</th>
                                    <th>الأسم</th>


                                    <th width="15%">التحكم</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($data as $key => $acc)
                                    @if(!$acc->parent_id)
                                        <tr class="table-active" style="-webkit-print-color-adjust: exact;">
                                            <td style="text-align:right">{{ $acc->code }}</td>
                                            <td style="text-align:right">{{ $acc->name }}</td>
                                            <td>

                                                @if(checkModulePermission('accounts', 'edit'))
                                                    <a href="{{ url(route('admin.acc_edit',['id'=>$acc->accountid])) }}"
                                                       class="btn btn-soft-success btn-icon btn-sm rounded-circle">
                                                        <i class="ri-edit-box-line fs-16"></i></a>
                                                @endif

                                            <!--   @if(checkModulePermission('events', 'delete'))
                                                <form method="post" class="d-inline"
                                                      action="{{ url(route('admin.acc_delete',$acc->accountid)) }}"
                                                >
                                                    @csrf
                                                    @method('delete')
                                                    <button
                                                        class="btn btn-soft-danger btn-icon btn-sm rounded-circle"
                                                        type="submit"><i class="ri-delete-bin-line fs-16"></i>
                                                    </button>

                                                </form>
                                            @endcan -->
                                                @if(checkModulePermission('accounts', 'delete'))
                                                    <a onclick="ensureConfirm(this)"
                                                       data-attr="{{ url(route('admin.acc_delete',$acc->accountid)) }}"
                                                       class="btn btn-soft-danger btn-icon btn-sm rounded-circle"><i
                                                            class="ri-delete-bin-line fs-16"></i>

                                                    </a>@endif


                                            </td>
                                        </tr>





                                        @if(!empty($acc->children ))
                                            @foreach($acc->children  as $keyChild => $item)
                                                <tr style="background-color:#cdf4cf;-webkit-print-color-adjust: exact;">
                                                    <td style="text-align:right">..... {{ $item->code }}</td>
                                                    <td style="text-align:right">..... {{ $item->name }}</td>
                                                    <td>
                                                        @if(checkModulePermission('accounts', 'edit'))
                                                            <a href="{{ url(route('admin.acc_edit',['id'=>$item->accountid])) }}"
                                                               class="btn btn-soft-success btn-icon btn-sm rounded-circle">
                                                                <i class="ri-edit-box-line fs-16"></i></a>
                                                        @endif
                                                        @if(checkModulePermission('accounts', 'delete'))
                                                            <a onclick="ensureConfirm(this)"
                                                               data-attr="{{ url(route('admin.acc_delete',$item->accountid)) }}"
                                                               class="btn btn-soft-danger btn-icon btn-sm rounded-circle"><i
                                                                    class="ri-delete-bin-line fs-16"></i>

                                                            </a>@endif
                                                    </td>
                                                </tr>
                                                <!-- third level -->
                                                @foreach($item->children  as $keyChild => $item3)

                                                    <tr @if(count($item3->children)>0) style="background-color:#fff6c8;-webkit-print-color-adjust: exact;" @endif>
                                                        <td style="text-align:right">.....
                                                            ..... {{ $item3->code }} </td>
                                                        <td style="text-align:right">..... ..... {{ $item3->name }}</td>
                                                        <td>
                                                            @if(checkModulePermission('accounts', 'edit'))
                                                                <a href="{{ url(route('admin.acc_edit',['id'=>$item3->accountid])) }}"
                                                                   class="btn btn-soft-success btn-icon btn-sm rounded-circle">
                                                                    <i class="ri-edit-box-line fs-16"></i></a>
                                                            @endif
                                                            @if(checkModulePermission('accounts', 'delete'))
                                                                <a onclick="ensureConfirm(this)"
                                                                   data-attr="{{ url(route('admin.acc_delete',$item3->accountid)) }}"
                                                                   class="btn btn-soft-danger btn-icon btn-sm rounded-circle"><i
                                                                        class="ri-delete-bin-line fs-16"></i>

                                                                </a>@endif
                                                        </td>
                                                    </tr>

                                                    <!-- forth level -->
                                                    @foreach($item3->children  as $keyChild => $item4)
                                                        <tr>
                                                            <td style="text-align:right">..... .....
                                                                ..... {{ $item4->code }}</td>
                                                            <td style="text-align:right">..... .....
                                                                ..... {{ $item4->name }}</td>
                                                            <td>
                                                                @if(checkModulePermission('accounts', 'edit'))
                                                                    <a href="{{ url(route('admin.acc_edit',['id'=>$item4->accountid])) }}"
                                                                       class="btn btn-soft-success btn-icon btn-sm rounded-circle">
                                                                        <i class="ri-edit-box-line fs-16"></i></a>
                                                                @endif
                                                                @if(checkModulePermission('accounts', 'delete'))
                                                                    <a onclick="ensureConfirm(this)"
                                                                       data-attr="{{ url(route('admin.acc_delete',$item4->accountid)) }}"
                                                                       class="btn btn-soft-danger btn-icon btn-sm rounded-circle"><i
                                                                            class="ri-delete-bin-line fs-16"></i>

                                                                    </a>@endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    <!-- forth level -->
                                                @endforeach
                                                <!-- third level -->
                                            @endforeach
                                        @endif

                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div> <!-- end card body-->
                </div> <!-- end card -->
            </div><!-- end col-->
        </div> <!-- end row-->


    </div> <!-- container -->

    <script>


        function CallPrintdiv(divid) {
            var disp_setting = "toolbar=yes,location=no,directories=yes,menubar=yes,";
            disp_setting += "scrollbars=yes,width=650, height=600, left=100, top=25";
            var content_vlue = document.getElementById(divid).innerHTML;
            var docprint = window.open("", "", disp_setting);
            docprint.document.open();
            docprint.document.write('<html><head><title style="direction:rtl !important;"> </title>');
            // docprint.document.write('</head><body onLoad="self.print()" style="direction:rtl !important;float: right !important;"> <p style="text-align:left"> <img src="http://smartvteam.com/jaz_system/template/admin/default/app-assets/images/logo/logo.png"> </p><br>');
            docprint.document.write(
                //   '</head><body onLoad="self.print()" style=""> <p style="text-align:center;padding-left:150px"> <span style="text-decoration:underline;font-size: 20px;">  </p>'
                '</head><body onLoad="self.print()" style=" "> <p style="text-align:center;padding-left:150px"> <span style="text-decoration:underline;font-size: 20px;">  </p>'
            );
            docprint.document.write(
                "<style>@page { size: auto;  margin: 5mm; }.show_in_print{display:block !important;}.watermark-text {  position: absolute;  top: 70%;  left: 50%;  transform: translate(-74%, 150%) rotate(-30deg);  font-size: 110px;  color: rgba(0, 0, 0, 0.03);   pointer-events: none;  white-space: nowrap;  z-index: 0;} table {    direction:ltr !important;}.print_center{text-align:center !important;}.show_block{display:block !important;}.dt-buttons{display:none !important;}.dataTables_info{display:none !important;}.print_hid{display:none}.align_center{font-size:12px !important;}.divfooter{position: fixed; bottom: 0;display:block !important;}.font12{font-size:12px !important;}.gray{background-color:#CACACA !important;-webkit-print-color-adjust: exact; }h4{-webkit-margin-before: 0px;-webkit-margin-after: 0px;-webkit-margin-start: 0px;-webkit-margin-end: 0px;}p{-webkit-margin-before: 0px;-webkit-margin-after: 0px;-webkit-margin-start: 0px;-webkit-margin-end: 0px;}h4{text-align:left;direction:ltr;}fc-event-title{font-size:11px !important;}.fc {direction: ltr;text-align: left;}.fc-event {color: #fff;font-size: .80em;cursor: default;}.fc-event-skin {border-color: #5078A0;background-color: #5078A0;color: #fff;}table{direction:ltr;}.table td{border: 1px solid #ddd!important;padding:2px}.table th{border: 1px solid #ddd!important;}.table{width:100% !important;text-align:left!important}.dataTables_filter{display:none !important;}.dataTables_length{display:none !important;}.first paginate_button paginate_button_disabled{display:none !important;}.dataTables_paginate{display:none !important;}.acont{display:none !important;} #cr{display:none}#cr2{display:none}#tSortable_info{display:none}fc-event fc-event-skin fc-event-hori fc-event-draggable fc-corner-left fc-corner-right{font-size:11px;}.show_print{display:block !important} .print-tables thead th{background: #af9c60!important;-webkit-print-color-adjust: exact !important;font-size: 12px!important;color: #fff!important;padding: 0.25rem !important;vertical-align: middle !important;height: 35px!important;border-spacing: 0!important;outline: none!important;}.print-tables tbody tr td a {text-decoration: underline!important;color: #8d6e0e!important;}.print-tables tbody td {border-bottom-width: 0!important;font-size: 12px!important;border-spacing: 0!important;border-bottom-width: 0!important;color: #404E67!important;}.print-tables td, .print-tables th {border-bottom: 1px solid #e3ebf3!important;border: 1px solid #e3ebf3!important;} table{direction:rtl !important;text-align:right !important} td{direction:rtl !important;text-align:right !important} th{direction:rtl !important;text-align:right !important} </style>");
            docprint.document.write(content_vlue);
            docprint.document.write('</center></body></html>');
            docprint.document.close();
            docprint.focus();
            WinPrint.print();
        }
    </script>

    <script>
        function ensureConfirm(obj) {
            if (window.confirm("{{__('lang.Do you really want to change status?')}}")) {
                window.location.href = obj.getAttribute('data-attr');
            }
        }
    </script>
@endsection

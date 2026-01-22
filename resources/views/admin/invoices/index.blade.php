@extends('admin.master')

@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.6.0/css/all.min.css">

    <div id="all" class="page-container my-4">
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
                <h4 class="header-title">{{__('lang.invoices')}}</h4>
            </div>
            <div class="col-12 col-md-4 text-md-end text-center">


                <div class="">

                    {{--                <a class="badge badge-outline-primary" href="{{url(route('admin.invoices.create'))}}">--}}
                    {{--                                {{__('lang.add_new')}} </a>--}}


                    {{--/**********excel btn**********/--}}
                    <span title="اكسيل" onclick="getDataExcel('{{url('/admin/invoice_all')}}', 'invoices.xlsx')"
                          target="_blank"
                          class="btn btn-sm btn-success  ">
                        <i class="ri-file-excel-line"></i>
                    </span>

                    {{--/*********excel brn**********/--}}

                    <span title="طباعة" onclick=" getDataPrint('{{url('/admin/invoice_all')}}')" class="btn btn-sm btn-danger  ">
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
                                    <a href="{{url(route('admin.invoices.index'))}}"
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
                                <th>inv_code</th>
                                <th>inv_type</th>
                                <th>inv_date</th>
                                <th>client_id</th>

                                <th>amount</th>
                                <th>tax</th>
                                <th>actions</th>

                            </tr>
                            </thead>
                            <tbody>


                            @forelse($invoices as $item)
                                <tr>
                                    <td>{{$item->inv_code}}</td>
                                    <td> {{__('lang.'.$item->inv_type)}}</td>
                                    <td>{{$item->inv_date}}</td>
                                    <td>{{optional($item->client)->name}}</td>
                                    <td>{{$item->amount}}</td>
                                    <td>{{$item->tax}}</td>
                                    <td class="td_actions">
                                        {{--                                        @if(checkModulePermission('admins', 'edit'))--}}
                                        {{--                                            <a href="{{url(route('admin.invoices.edit' , $item->id))}}"--}}
                                        {{--                                               class="btn btn-soft-success btn-icon btn-sm rounded-circle mx-1">--}}
                                        {{--                                                <i class="ri-edit-box-line fs-16"></i>--}}
                                        {{--                                            </a>--}}
                                        {{--                                        @endif--}}
                                        @if(checkModulePermission('admins', 'show'))
                                            <a href="{{url(route('admin.invoices.show' , $item->id) . "?list=invoices")}}"
                                               class="btn btn-soft-success btn-icon btn-sm rounded-circle mx-1">
                                                <i class="ri-eye-line fs-16"></i>
                                            </a>
                                        @endif

                                        @if(checkModulePermission('admins', 'show'))
                                            <a
                                                class="btn btn-soft-success btn-icon btn-sm rounded-circle mx-1"
                                                onclick="printDivAndGetData('pr{{$item->id}}' , {{$item->id}})">
                                                <i class="ri-printer-line fs-16"></i>
                                            </a>
                                        @endif

                                        @if(checkModulePermission('admins', 'delete'))
                                            <form action="{{route('admin.invoices.destroy' , $item->id)}}" method="post"
                                            >
                                                @csrf
                                                @method('DELETE')
                                                <div class="btn btn-soft-success btn-icon btn-sm rounded-circle"
                                                     onclick="confirmDeletion(this)"><i
                                                        class="ri-delete-bin-line fs-16"></i></div>

                                            </form>
                                        @endif </td>
                                </tr>

                                <!---------------------start print ------------>
                                <div id="pr{{$item->id}}" style="display: none">

                                    {{--                                    @include('admin.invoices.print', ['items'=>@$item])--}}
                                </div>
                                <!-----end print ------------->
                            @empty

                            @endforelse
                            </tbody>
                        </table>

                        {{$invoices->links()}}
                    </div>

                </div>
            </div>

            <div class="mt-4 d-flex justify-content-center">
                {{--  <!--{{ $members->appends(request()->query())->links() }}-->   --}}
                {{count($invoices) ? $invoices->links() : ''}}
            </div>

        </div>
    </div>



    <!---------------------start print all grid ------------>
    <div id="pr" style="display: none">
        @include('admin.invoices.print', ['invoices'=>@$invoices])
    </div>
    <!-----end all grid ------------->

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








        ///////////////get data of each invoice (single invoice)
        // <!---start printDivAndGetData --->
        function printDivAndGetData(divId, id) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'POST',
                url: "{{url('/admin/getmsg/')}}" +'/'+ id,
                {{--data: '_token = <?php echo csrf_token() ?>',--}}
                success: function (data) {
                    const lang = {
                        date: "{{ __('lang.date') }}",
                        amount_before_tax: "{{ __('lang.amount_before_tax') }}",
                        tax: "{{ __('lang.tax') }}",
                        amount: "{{ __('lang.amount') }}",
                        id: "{{ __('lang.id') }}",
                        ticket_no: "{{ __('lang.ticket_no') }}",
                        traveller_name: "{{ __('lang.traveller_name') }}",
                        from_city: "{{ __('lang.from_city') }}",
                        to_city: "{{ __('lang.to_city') }}",
                        book_date: "{{ __('lang.book_date') }}",
                        travel_date: "{{ __('lang.travel_date') }}",
                        airline: "{{ __('lang.airline') }}",
                        client: "{{ __('lang.client') }}",
                        notes: "{{ __('lang.notes') }}"
                    };

                    const hh = document.getElementById(divId);
                    hh.innerHTML = '';


                    var n = '' ;


                    n+= `  <div
    dir="rtl"
    style="
      margin: 0;
      padding: 20px 0;
      background: #f4f6f8;
      font-family: Arial, sans-serif;
    "
  >
    <div
      style="
        width: 98%;
        margin: auto;
        background: #ffffff;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
        border-radius: 8px;
        overflow: hidden;
      "
    >
                    <header
                    style="
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    padding: 16px 24px;
                    border-bottom: 2px solid #e5e5e5;
                    "
                    >
                    <div
                    style="
                    width: 35%;
                    text-align: right;
                    font-size: 13px;
                    color: #555;
                    line-height: 1.6;
                    "
                    >
                    <div
                    style="
                    font-weight: bold;
                    color: #b28b2e;
                    font-size: 15px;
                    margin-bottom: 4px;
                    "
                    >
                    نظام شركات السياحة
                    </div>
                    <div>مكرم عبيد، مدينة نصر - القاهرة - مصر</div>
                    <div>📞 0222222222 | 0122555555</div>
                    <div>✉ testtest@gmail.com</div>
                    </div>

                    <div style="width: 30%; text-align: center">
                    <img
                    src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/6b/Airplane_silhouette.svg/512px-Airplane_silhouette.svg.png"
                    alt="Logo"
                    style="width: 80px; opacity: 0.85"
                    />
                    <div
                    style="
                    margin-top: 6px;
                    font-size: 16px;
                    font-weight: bold;
                    color: #164f63;
                    letter-spacing: 1px;
                    "
                    >
                    الفاتورة
                    </div>
                    </div>

                     `;


                  n += `<div
                    style="
                    width: 35%;
                    text-align: left;
                    font-size: 13px;
                    color: #555;
                    line-height: 1.6;
                    "
                    >
                    <div style="font-size: 12px; margin-bottom: 6px; color: #777">
                    14 Jan 2025 – 12:21 PM
                    </div>
                    <div
                    style="
                    font-weight: bold;
                    color: #b28b2e;
                    font-size: 15px;
                    margin-bottom: 4px;
                    "
                    >
                    Tourism Management System
                    </div>
                    <div>Makram Abeid, Nasr City, Cairo, Egypt</div>
                    <div>📞 0222222222 | 0122555555</div>
                    <div>✉ testtest@gmail.com</div>
                    </div>
                    </header>

                    `;




                    n+= `
                    <div style="padding: 20px">
                    <h3
                    style="
                    margin: 0 0 14px;
                    padding-bottom: 6px;
                    border-bottom: 2px solid #164f63;
                    color: #164f63;
                    "
                    >
                    تفاصيل الفاتورة
                    </h3>

                    <table
                    style="
                    width: 100%;
                    border-collapse: collapse;
                    text-align: right;
                    font-size: 14px;
                    "
                    >
                    <tr>
                    <td
                    style="
                    border: 1px solid #e0e0e0;
                    background: #f9fcfe;
                    padding: 10px;
                    color: #777;
                    font-weight: bold;
                    "
                    >
                    رمز الفاتورة
                    </td>
                    <td style="border: 1px solid #e0e0e0; padding: 10px">${data[0].ticket_no}</td>

                    <td
                    style="
                    border: 1px solid #e0e0e0;
                    background: #f9fcfe;
                    padding: 10px;
                    color: #777;
                    font-weight: bold;
                    "
                    >
                    النوع
                    </td>
                    <td style="border: 1px solid #e0e0e0; padding: 10px">
                    Flight Ticket
                    </td>
                    </tr>

                    <tr>
                    <td
                    style="
                    border: 1px solid #e0e0e0;
                    background: #f9fcfe;
                    padding: 10px;
                    color: #777;
                    font-weight: bold;
                    "
                    >
                    التاريخ
                    </td>
                    <td style="border: 1px solid #e0e0e0; padding: 10px"> ${data[0].inv_date}
                    </td>

                    <td
                    style="
                    border: 1px solid #e0e0e0;
                    background: #f9fcfe;
                    padding: 10px;
                    color: #777;
                    font-weight: bold;
                    "
                    >
                    الضريبة
                    </td>
                    <td style="border: 1px solid #e0e0e0; padding: 10px">(14%) ${data[0].invoice_tax}</td>
                    </tr>

                    <tr>
                    <td
                    style="
                    border: 1px solid #e0e0e0;
                    background: #f9fcfe;
                    padding: 10px;
                    color: #777;
                    font-weight: bold;
                    "
                    >
                    العميل
                    </td>
                    <td style="border: 1px solid #e0e0e0; padding: 10px">
                   ${data[0].client_name}
                    </td>

                    <td
                    style="
                    border: 1px solid #e0e0e0;
                    background: #f9fcfe;
                    padding: 10px;
                    color: #777;
                    font-weight: bold;
                    "
                    >
                    إجمالي المبلغ
                    </td>
                    <td
                    style="
                    border: 1px solid #e0e0e0;
                    padding: 10px;
                    font-weight: bold;
                    color: #164f63;
                    "
                    >
                    ${data[0].invoice_amount - data[0].invoice_tax}
                    </td>
                    </tr>
                    </table>
                    </div>

                    <div style="padding: 20px">
                    <h3
                    style="
                    margin: 0 0 14px;
                    padding-bottom: 6px;
                    border-bottom: 2px solid #164f63;
                    color: #164f63;
                    "
                    >
                    عناصر الفاتورة
                    </h3>

                    <div
                    style="
                    width: 100%;
                    overflow-x: auto;
                    overflow-y: auto;
                    max-height: 350px;
                    border: 1px solid #e0e0e0;
                    border-radius: 6px;
                    "
                    >
                    <table
                    style="
                    width: 100%;
                    min-width: 1100px;
                    border-collapse: collapse;
                    text-align: right;
                    font-size: 13px;
                    "
                    >
                    <thead>
                    <tr style="background: #164f63; color: #ffffff">
                    <th style="border: 1px solid #ddd; padding: 8px">${lang.id}</th>
                    <th style="border: 1px solid #ddd; padding: 8px">
                        ${lang.ticket_no}
                    </th>
                    <th style="border: 1px solid #ddd; padding: 8px">
                        ${lang.traveller_name}
                    </th>
                    <th style="border: 1px solid #ddd; padding: 8px">
                        ${lang.from_city}
                    </th>
                    <th style="border: 1px solid #ddd; padding: 8px">
                        ${lang.to_city}
                    </th>
                    <th style="border: 1px solid #ddd; padding: 8px">
                        ${lang.amount}
                    </th>
                    <th style="border: 1px solid #ddd; padding: 8px">
                        ${lang.book_date}
                    </th>
                    <th style="border: 1px solid #ddd; padding: 8px">
                        ${lang.travel_date}
                    </th>
                    <th style="border: 1px solid #ddd; padding: 8px">
                        ${lang.airline}
                    </th>
                    <th style="border: 1px solid #ddd; padding: 8px">
                        ${lang.client}
                    </th>
                    <th style="border: 1px solid #ddd; padding: 8px">
                        ${lang.notes}
                    </th>
                    </tr>
                    </thead>

                    <tbody>
                    `;
                    /* ---------------- TABLE ROWS ---------------- */
                    data.forEach(item => {
                        n += `
    <tr>
        <td style="border:1px solid #000;padding:6px;">${item.id}</td>
        <td style="border:1px solid #000;padding:6px;">${item.ticket_no}</td>
        <td style="border:1px solid #000;padding:6px;">${item.traveller_name}</td>
        <td style="border:1px solid #000;padding:6px;">${item.from_city}</td>
        <td style="border:1px solid #000;padding:6px;">${item.to_city}</td>
        <td style="border:1px solid #000;padding:6px;">${item.final_amount}</td>
        <td style="border:1px solid #000;padding:6px;">${item.book_date}</td>
        <td style="border:1px solid #000;padding:6px;">${item.travel_date}</td>
        <td style="border:1px solid #000;padding:6px;">${item.airline_name}</td>
        <td style="border:1px solid #000;padding:6px;">${item.client_name}</td>
        <td style="border:1px solid #000;padding:6px;">
            <textarea style="width:100%;min-height:40px;">${item.notes}</textarea>
        </td>
    </tr>
    `;

                    });


                    n+= `            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
`;
                    hh.innerHTML= n;

                    printDiv(divId);
                }
            });
        }
        // <!---end printDivAndGetData --->


        function confirmDeletion(obj) {
            const form = obj.parentNode;
            if (!confirm('Are you sure you want to delete this item?')) {
                return;
            }

            return form.submit();
        }




    </script>








@endsection

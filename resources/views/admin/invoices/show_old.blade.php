@extends('admin.master')
@section('content')
    <style>
        .bottom_border {

            border-bottom: 2px solid #ff000033;
            width: 80%;
            margin: auto;
            padding-top: 19px;
        }

        .gray_container_invoice{
            border-radius: 53px;
            padding: 31px;
            background-color: #d3d3d342;
            padding-bottom: 62px;
            width:85%;
        }
    </style>
    {{--    'inv_type',--}}
    {{--    'inv_date',--}}
    {{--    'amount',--}}
    {{--    'tax',--}}
    {{--    'client_id',--}}


    <div class="page-container">
        <div class="col-12 d-flex justify-content-between align-items-center my-3">
            <div class="col-md-8">
                <h4 class="header-title">{{__('lang.invoice')}} <span
                        class="text-primary">INV-{{$invoice[0]->inv_code}}</span></h4>
            </div>
            <div class="col-md-4">
                <a href="{{ url(route('admin.flight_tickets.index')) }}"
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
            <form action="{{route('admin.invoices.update' , $invoice[0]->inv_id)}}" class="card" method="post">
                @csrf
                @method('PUT')
{{--                'id',--}}
{{--                'airline_id',--}}
{{--                'ticket_no',--}}
{{--                'traveller_name',--}}
{{--                'from_city',--}}
{{--                'to_city',--}}
{{--                'price',--}}
{{--                'airline_com',--}}
{{--                'additional_fees',--}}
{{--                'book_date',--}}
{{--                'travel_date',--}}
{{--                'client_id',--}}
{{--                'invoice_id',--}}
{{--                'discount',--}}

                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-4">
                            <label for="date" class="col-form-label">{{__('lang.date')}}</label>
                            <input type="date" name="date"
                                   value="{{$invoice[0]->inv_date?date_create($invoice[0]->inv_date)->format('Y-m-d') : date('Y-m-d')}}"
                                   class="form-control"/>
                        </div>
                        <div class="container gray_container_invoice">
                            <div class=" row bottom_border">
                                <label for="amounts" class="col-md-3 col-sm-6 text-primary">{{__('lang.amount_before_tax')}}</label>
                                <h4 id="amounts" class="col-md-9 col-sm-6">{{ $invoice[0]->invoice_amount }}</h4>
                            </div>
                            <div class="row bottom_border">
                                <label for="tax" class=" col-md-3 col-sm-6 text-primary">{{__('lang.tax')}}</label>
                                <h4 id="tax" class="col-md-9 col-sm-6"> (14%) {{ $invoice[0]->invoice_tax }}</h4>
                            </div>

                            <div class="row bottom_border">
                                <label for="amount" class=" col-md-3  col-sm-6 text-primary">{{__('lang.amount')}}</label>
                                <h4 id="amount" class="col-md-9 col-sm-6">{{ $invoice[0]->invoice_amount +  $invoice[0]->invoice_tax  }}</h4>
                            </div>


                        </div>

                    </div>
                </div>




                <div class="card shadow-sm border-0">
                    <div class="card-body">

                        <div class="card border-success mb-3 rounded-3 overflow-hidden">

                            <div class="card-body">
                                 <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>{{__('lang.id')}}</th>
                                        <th>{{ __('lang.ticket_no') }}</th>
                                        <th>{{ __('lang.traveller_name') }}</th>
                                        <th>{{ __('lang.from_city') }}</th>
                                        <th>{{ __('lang.to_city') }}</th>
                                        <th>{{ __('lang.amount') }}</th>
{{--                                        <th>{{ __('lang.airline_com') }}</th>--}}
{{--                                        <th>{{ __('lang.additional_fees') }}</th>--}}
{{--                                        <th>{{ __('lang.discount') }}</th>--}}
                                        <th>{{ __('lang.book_date') }}</th>
                                        <th>{{ __('lang.travel_date') }}</th>
                                        <th>{{ __('lang.airline') }}</th>
                                        <th>{{ __('lang.client') }}</th>
                                        <th>{{ __('lang.notes') }}</th>
{{--                                        <th>{{ __('lang.actions') }}</th>--}}
                                    </tr>
                                    </thead>

                                    <tbody>

                                     @forelse($invoice as $key => $item)
                                        <tr>
                                            <td>{{$item->id}}</td>
                                            <td>{{ $item->ticket_no }}</td>
                                            <td>{{ $item->traveller_name }}</td>
                                            <td>{{ $item->from_city }}</td>
                                            <td>{{ $item->to_city }}</td>
                                            <td>{{ number_format($item->final_amount, 2) }}</td>
{{--                                            <td>{{ number_format($item->airline_com ?? 0, 2) }}</td>--}}
{{--                                            <td>{{ number_format($item->additional_fees ?? 0, 2) }}</td>--}}
{{--                                            <td>{{ number_format($item->discount ?? 0, 2) }}</td>--}}
                                            <td>{{ $item->book_date }}</td>
                                            <td>{{ $item->travel_date }}</td>
                                            <td>{{  $item->airline_name }}</td>
                                            <td>   {{ $item->client_name}}</td>
                                            <td> <input type="number" name="invoice_item_id[]" value="{{$item->invoice_item_id}}" class="d-none"> <textarea class="textAreaInvoices" name="notes[]">{{$item->notes}}</textarea> </td>
{{--                                            <td>--}}
{{--                                                @if($item->invoice_id)--}}
{{--                                                    --}}{{--                                            <i class="fa fa-check text-success"></i>--}}
{{--                                                    <span class="badge bg-light text-primary" >{{  $item->inv_code}}</span>--}}
{{--                                                @else--}}
{{--                                                    <i class="fa fa-minus text-secondary"></i>--}}
{{--                                                @endif--}}
{{--                                            </td>--}}

{{--                                            <td class="td_actions">--}}
{{--                                                @if(checkModulePermission('admins', 'edit'))--}}
{{--                                                    <a href="{{ route('admin.flight_tickets.edit', $item->id) }}"--}}
{{--                                                       class="btn btn-soft-success btn-icon btn-sm rounded-circle mx-1">--}}
{{--                                                        <i class="ri-edit-box-line fs-16"></i>--}}
{{--                                                    </a>--}}
{{--                                                @endif--}}

{{--                                                @if(checkModulePermission('admins', 'delete'))--}}
{{--                                                    <form action="{{ route('admin.flight_tickets.destroy', $item->id) }}"--}}
{{--                                                          method="POST" style="display:inline;">--}}
{{--                                                        @csrf--}}
{{--                                                        @method('DELETE')--}}
{{--                                                        <div class="btn btn-soft-success btn-icon btn-sm rounded-circle"--}}
{{--                                                             onclick="confirmDeletion(this)">--}}
{{--                                                            <i class="ri-delete-bin-line fs-16"></i>--}}
{{--                                                        </div>--}}
{{--                                                    </form>--}}
{{--                                                @endif--}}
{{--                                            </td>--}}
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="14" class="text-center">No flight tickets found</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
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

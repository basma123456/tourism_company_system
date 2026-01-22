

@include('admin.layouts.header_print')

  {{-- Filtered Data --}}
<div class="card shadow-sm border-0">
    <div class="card-body">

        <div class="card border-success mb-3 rounded-3 overflow-hidden">

            <div class="card-body">


                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>{{ __('lang.ticket_no') }}</th>
                        <th>{{ __('lang.traveller_name') }}</th>
                        <th>{{ __('lang.from_city') }}</th>
                        <th>{{ __('lang.to_city') }}</th>
                        <th>{{ __('lang.price') }}</th>
                        <th>{{ __('lang.airline_com') }}</th>
                        <th>{{ __('lang.additional_fees') }}</th>
                        <th>{{ __('lang.discount') }}</th>
                        <th>{{ __('lang.book_date') }}</th>
                        <th>{{ __('lang.travel_date') }}</th>
                        <th>{{ __('lang.airline') }}</th>
                        <th>{{ __('lang.client') }}</th>
                        <th>{{ __('lang.invoice') }}</th>
                     </tr>
                    </thead>

                    <tbody>
                    @forelse($flightTickets as $item)
                        <tr>
                            <td>@if(!$item->invoice_id)<input type="checkbox" onchange="submitCheckBoxes()"
                                                              name="ids[]"
                                                              class="checkboxes"
                                                              data-attr="{{$item->client_id}}"
                                                              value="{{$item->id}}">
                                @endif
                            </td>
                            <td>{{ $item->ticket_no }}</td>
                            <td>{{ $item->traveller_name }}</td>
                            <td>{{ $item->from_city }}</td>
                            <td>{{ $item->to_city }}</td>
                            <td>{{ number_format($item->price, 2) }}</td>
                            <td>{{ number_format($item->airline_com ?? 0, 2) }}</td>
                            <td>{{ number_format($item->additional_fees ?? 0, 2) }}</td>
                            <td>{{ number_format($item->discount ?? 0, 2) }}</td>
                            <td>{{ $item->book_date }}</td>
                            <td>{{ $item->travel_date }}</td>
                            <td>{{ $item->airline?->name }}</td>
                            <td>{{ $item->client?->name }}  {{ $item->client_id}}</td>
                            <td>
                                @if($item->invoice_id)
                                    {{--                                            <i class="fa fa-check text-success"></i>--}}
                                    <span  onclick="window.location.href = '{{url(route('admin.invoices.show' , $item->invoice_id))}}'" class="badge bg-light text-primary">{{optional($item->invoice)->inv_code}}</span>
                                @else
                                    <i class="fa fa-minus text-secondary"></i>
                                @endif
                            </td>

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

    <div class="mt-4 d-flex justify-content-center">
        {{--  <!--{{ $members->appends(request()->query())->links() }}-->   --}}
    </div>

</div>

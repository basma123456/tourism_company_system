
@include('admin.layouts.header_print')

{{-- Filtered Data --}}
<div class="card shadow-sm border-0">
    <div class="card-body">

        <div class="card border-success mb-3 rounded-3 overflow-hidden">

            <div class="card-body">


                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>{{__('lang.Fcode')}}</th>
                        <th>{{__('lang.Ftype')}}</th>
                        <th>{{__('lang.Fname')}}</th>
                        <th>{{__('lang.emp')}}</th>
                        <th>{{__('lang.adults_no')}}</th>
                        <th>{{__('lang.child_no')}}</th>
                        <th>{{__('lang.infants_no')}}</th>
                        <th>{{__('lang.arrival_date')}}</th>
                        <th>{{__('lang.leave_date')}}</th>
                        <th>{{__('lang.nationality')}}</th>
                        <th>{{__('lang.created_date')}}</th>
                        <th>{{__('lang.closed')}}</th>
                        <th>{{__('lang.approved')}}</th>

                    </tr>
                    </thead>
                    <tbody>

                    @forelse($tourismFiles as $item)
                        <tr>
                            <td> {{$item->Fcode}}</td>
                            <td> {{$item->Ftype}}</td>
                            <td> {{$item->Fname}}</td>
                            <td> {{$item->emp}}</td>
                            <td> {{$item->adults_no}}</td>
                            <td> {{$item->child_no}}</td>
                            <td> {{$item->infants_no}}</td>
                            <td> {{$item->arrival_date_only}}</td>
                            <td> {{$item->leave_date_only}}</td>
                            <td> {{$item->country?->$country_name}}</td>
                            <td> {{$item->created_date_only}}</td>
                            <td>@if($item->closed == 1) {{__('lang.yes')}} @else  {{__('lang.no')}}  @endif</td>
                            <td>@if($item->approved == 1)  {{__('lang.yes')}} @else  {{__('lang.no')}}  @endif</td>


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

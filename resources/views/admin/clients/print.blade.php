

@include('admin.layouts.header_print')

  {{-- Filtered Data --}}
<div class="card shadow-sm border-0">
    <div class="card-body">

        <div class="card border-success mb-3 rounded-3 overflow-hidden">

            <div class="card-body">


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

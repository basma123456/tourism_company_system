

@include('admin.layouts.header_print')

  {{-- Filtered Data --}}
<div class="card shadow-sm border-0">
    <div class="card-body">

        <div class="card border-success mb-3 rounded-3 overflow-hidden">

            <div class="card-body">


                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>{{__('lang.name')}}</th>
                        <th>{{__('lang.active')}}</th>

                    </tr>
                    </thead>
                    <tbody>

                    @forelse($companyFields as $item)
                        <tr>
                            <td> {{$item->name}}</td>
                            <td>@if($item->active == 1) {{__('lang.yes')}}@else  {{__('lang.no')}}  @endif</td>
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

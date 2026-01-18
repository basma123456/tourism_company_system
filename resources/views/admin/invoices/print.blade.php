

@include('admin.layouts.header_print')

  {{-- Filtered Data --}}
<div class="card shadow-sm border-0">
    <div class="card-body">

        <div class="card border-success mb-3 rounded-3 overflow-hidden">

            <div class="card-body">


                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>inv_code</th>
                        <th>inv_type</th>
                        <th>inv_date</th>
                        <th>client_id</th>
                        <th>amount</th>
                        <th>tax</th>

                    </tr>
                    </thead>
                    <tbody>


                    @forelse($invoices as $item)
                        <tr>
                            <td>{{$item->inv_code}}</td>
                            <td> {{ $item->inv_type }}</td>
                            <td>{{$item->inv_date}}</td>
                            <td>{{optional($item->client)->name}}</td>
                            <td>{{$item->amount}}</td>
                            <td>{{$item->tax}}</td>
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

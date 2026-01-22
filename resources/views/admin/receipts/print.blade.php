

@include('admin.layouts.header_print')

  {{-- Filtered Data --}}
<div class="card shadow-sm border-0">
    <div class="card-body">

        <div class="card border-success mb-3 rounded-3 overflow-hidden">

            <div class="card-body">


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

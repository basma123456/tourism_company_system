@extends('admin.master')
@section('content')
    <div class="page-container">

        <div class="col-12 d-flex flex-wrap justify-content-between align-items-center my-3">
            <div class="col-8 col-md-8 mb-2 mb-md-0">
                <h4 class="header-title">{{__('lang.add_FlightTicket')}}</h4>
            </div>
            <div class="col-4 col-md-4 text-center text-md-end">
                <a href="{{ url(route('admin.flight_tickets.index')) }}"
                   class="btn btn-soft-info rounded-pill  float-end"><i
                        class="ri-arrow-go-back-line"></i><span
                        class="d-none d-sm-inline"> &nbsp;&nbsp;{{__('lang.Back')}}   </span></a>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">

                    @if ($errors->any()) @foreach ($errors->all() as $error)
                        <div class="text-danger">{{$error}}</div>
                    @endforeach
                    <br>
                    @endif


                    <form action="{{ url(route('admin.flight_tickets.store')) }}" method="POST"
                          class="form-horizontal"> @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <label for="airline_id" class=" col-form-label">{{__('lang.airlines')}}</label>
                                <div class="col-12">
                                    <select name="airline_id" class="form-control select2" data-toggle="select2"
                                            id="airline_id">
                                        <option value="">...</option>
                                        @foreach($airlines as $airline)
                                            <option value="{{$airline->id}}">{{$airline->name}}</option>
                                        @endforeach

                                    </select>
                                    @error('airline_id')
                                    <div class="text-danger">{{$message}}</div> @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label for="ticket_no" class=" col-form-label">{{__('lang.ticket_no')}}</label>
                                <div class="col-12">
                                    <input type="text" name="ticket_no" class="form-control"
                                           value="{{old('ticket_no')}}"
                                           id="from_city"
                                           placeholder="{{__('lang.ticket_no')}}">
                                    @error('ticket_no')
                                    <div class="text-danger">{{$message}}</div> @enderror
                                </div>
                            </div>


                            <div class="col-md-4">
                                <label for="traveller_name"
                                       class=" col-form-label">{{__('lang.traveller_name')}}</label>
                                <div class="col-12">
                                    <input type="text" name="traveller_name" class="form-control"
                                           value="{{old('traveller_name')}}"
                                           id="traveller_name"
                                           placeholder="{{__('lang.traveller_name')}}">
                                    @error('traveller_name')
                                    <div class="text-danger">{{$message}}</div> @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="client_id" class=" col-form-label">{{__('lang.client')}}</label>
                                <div class="col-12">
                                    <select name="client_id" class="form-control select2" id="client_id"
                                            data-toggle="select2">
                                        <option value="">...</option>
                                        @foreach($clients as $client)
                                            <option value="{{$client->id}}">{{$client->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('client_id')
                                    <div class="text-danger">{{$message}}</div> @enderror
                                </div>
                            </div>


                            <div class="col-md-4">
                                <label for="from_city" class=" col-form-label">{{__('lang.from_city')}}</label>
                                <div class="col-12">
                                    <input type="text" name="from_city" class="form-control"
                                           value="{{old('from_city')}}"
                                           id="from_city"
                                           placeholder="{{__('lang.from_city')}}">
                                    @error('from_city')
                                    <div class="text-danger">{{$message}}</div> @enderror
                                </div>
                            </div>


                            <div class="col-md-4">
                                <label for="to_city" class=" col-form-label">{{__('lang.to_city')}}</label>
                                <div class="col-12">
                                    <input type="text" name="to_city" class="form-control" value="{{old('to_city')}}"
                                           id="to_city"
                                           placeholder="{{__('lang.to_city')}}">
                                    @error('to_city')
                                    <div class="text-danger">{{$message}}</div> @enderror
                                </div>
                            </div>


                            <div class="col-md-4">
                                <label for="price" class=" col-form-label">{{__('lang.price')}}</label>
                                <div class="col-12">
                                    <input type="number" step="any" name="price" class="form-control"
                                           value="{{old('price')}}"
                                           id="price"
                                           placeholder="{{__('lang.price')}}">
                                    @error('price')
                                    <div class="text-danger">{{$message}}</div> @enderror
                                </div>
                            </div>


                            <div class="col-md-4">
                                <label for="airline_com" class=" col-form-label">{{__('lang.airline_com')}}</label>
                                <div class="col-12">
                                    <input type="number" step="any" name="airline_com" class="form-control"
                                           value="{{old('airline_com')}}"
                                           id="airline_com"
                                           placeholder="{{__('lang.airline_com')}}">
                                    @error('airline_com')
                                    <div class="text-danger">{{$message}}</div> @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label for="additional_fees"
                                       class=" col-form-label">{{__('lang.additional_fees')}}</label>
                                <div class="col-12">
                                    <input type="number" step="any" name="additional_fees" class="form-control"
                                           value="{{old('additional_fees')}}"
                                           id="additional_fees"
                                           placeholder="{{__('lang.additional_fees')}}">
                                    @error('additional_fees')
                                    <div class="text-danger">{{$message}}</div> @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label for="discount" class=" col-form-label">{{__('lang.discount')}}</label>
                                <div class="col-12">
                                    <input type="number" step="any" name="discount" class="form-control"
                                           value="{{old('discount')}}"
                                           id="discount"
                                           placeholder="{{__('lang.discount')}}">
                                    @error('discount')
                                    <div class="text-danger">{{$message}}</div> @enderror
                                </div>
                            </div>


                            <div class="col-md-4">
                                <label for="book_date" class=" col-form-label">{{__('lang.book_date')}}</label>
                                <div class="col-12">
                                    <input type="date" name="book_date" class="form-control"
                                           value="{{old('book_date')}}"
                                           id="book_date">
                                    @error('book_date')
                                    <div class="text-danger">{{$message}}</div> @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label for="travel_date" class=" col-form-label">{{__('lang.travel_date')}}</label>
                                <div class="col-12">
                                    <input type="date" name="travel_date" class="form-control"
                                           value="{{old('travel_date')}}"
                                           id="travel_date">
                                    @error('travel_date')
                                    <div class="text-danger">{{$message}}</div> @enderror
                                </div>
                            </div>

                            <div class="col-12">
                                <a class="btn btn-soft-dark rounded-pill px-3 text-primary border-primary"
                                   onclick="addTransitePlace()">add transite</a>
                            </div>


                            <div class="row" id="transite_div">

                            </div>


                        </div>


                        <div
                            class="col-12 col-md-3 offset-md-9 d-flex justify-content-center justify-content-md-end mb-3 mt-3">
                            <button type="submit" class="btn btn-primary rounded-pill px-3">
                                <i class="ri-user-add-line"></i> &nbsp;&nbsp; {{__('lang.Add')}}
                            </button>
                        </div>
                </div>
                </form><!--here end form -->
            </div>
            <!-- end card-body -->
        </div>
    </div>


    </div>
@endsection

@section('scripts')
    <script>
        function addTransitePlace() {
            const newDiv =
                "<div class='row d-flex' style='justify-content:center'>" +
                "                            <div class=\"col-md-4\">\n" +
                "                                <label for='from_transite_place' class=' col-form-label'>{{__('lang.from_city')}}</label>\n" +
                "                                <div class=\"col-12\">\n" +
                "                                    <input type=\"text\" name='from_transite_place[]'  required class=\"form-control\"\n" +
                "                                           value='' " +
                "                                           id=\"from_transite_place\">\n" +
                "                                </div>\n" +
                "                            </div>\n" +
                "                            <div class=\"col-md-4\">\n" +
                "                                <label for='to_transite_place' class=\" col-form-label\">{{__('lang.to_city')}}</label>\n" +
                "                                <div class=\"col-12\">\n" +
                "                                    <input type=\"text\" name='to_transite_place[]' class=\"form-control\"\n" +
                "                                           value='' " +
                "                                           id=\"to_transite_place\">\n" +
                "                                </div>\n" +
                "                            </div>\n" +
                "<div style='width:20px; height:30px; margin-top: 43px;' class='btn btn-primary  btn-sm'  onclick='this.parentNode.remove()'><i class='ri-delete-bin-line fs-16'></i></div></div>";

            const main_div = document.getElementById('transite_div');
            // main_div.innerHTML += newDiv;
            main_div
                .insertAdjacentHTML('beforeend', newDiv);
        }
    </script>
@endsection

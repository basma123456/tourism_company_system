@extends('admin.master')
@section('content')

    <div class="page-container">

        <div class="col-12 d-flex justify-content-between align-items-center my-3">
            <div class="col-md-8">
                <h4 class="header-title">{{__('lang.TourismFile_edit')}} {{$flightTicket->Fname}}</h4>
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


            @if ($errors->any()) @foreach ($errors->all() as $error)
                <div class="text-danger">{{$error}}</div>
            @endforeach
            <br>
            @endif

            <form action="{{route('admin.flight_tickets.update' , $flightTicket->id)}}" class="card" method="post">
                @csrf
                @method('PUT')
                <input type="text" class="d-none" value="{{$flightTicket->id}}" name="id">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="airline_id" class=" col-form-label">{{__('lang.airlines')}}</label>
                            <div class="col-12">
                                <select name="airline_id" class="form-control select2" data-toggle="select2"
                                        id="airline_id">
                                    <option value="">...</option>
                                    @foreach($airlines as $airline)
                                        <option
                                            {{$flightTicket->airline_id === $airline->id ? 'selected' : ''}} value="{{$airline->id}}">{{$airline->name}}</option>
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
                                       value="{{$flightTicket->ticket_no }}"
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
                                       value="{{ $flightTicket->traveller_name }}"
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
                                        <option
                                            {{$flightTicket->client_id === $client->id ? 'selected' : ''}}  value="{{$client->id}}">{{$client->name}}</option>
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
                                       value="{{$flightTicket->from_city }}"
                                       id="from_city"
                                       placeholder="{{__('lang.from_city')}}">
                                @error('from_city')
                                <div class="text-danger">{{$message}}</div> @enderror
                            </div>
                        </div>


                        <div class="col-md-4">
                            <label for="to_city" class=" col-form-label">{{__('lang.to_city')}}</label>
                            <div class="col-12">
                                <input type="text" name="to_city" class="form-control"
                                       value="{{$flightTicket->to_city }}"
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
                                       value="{{$flightTicket->price }}"
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
                                       value="{{$flightTicket->airline_com }}"
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
                                       value="{{$flightTicket->additional_fees }}"
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
                                       value="{{$flightTicket->discount }}"
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
                                       value="{{$flightTicket->book_date }}"
                                       id="book_date">
                                @error('book_date')
                                <div class="text-danger">{{$message}}</div> @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="travel_date" class=" col-form-label">{{__('lang.travel_date')}}</label>
                            <div class="col-12">
                                <input type="date" name="travel_date" class="form-control"
                                       value="{{$flightTicket->travel_date }}"
                                       id="travel_date">
                                @error('travel_date')
                                <div class="text-danger">{{$message}}</div> @enderror
                            </div>
                        </div>


                        @if(count($flightTicket->transitePlaces))
                            <br>
                            <br>

                            <div class="row">
                                <div class="col-12 text-center">
                                    <h3 class="text-primary"><strong class="red_bottom_border">current transites</strong></h3>
                                </div>

                                <div class='row d-flex' style='justify-content:center'>
                                @foreach($flightTicket->transitePlaces as $place)
                                        <div class="col-md-4">
                                            <label for='from_transite_place'
                                                   class=' col-form-label'>{{__('lang.from_city')}}</label>
                                            <div class="col-12">
                                                <input  disabled class="form-control" type="text"
                                                       value='{{$place->from_transite_city}}'
                                                       id="from_transite_place">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for='to_transite_place'
                                                   class=" col-form-label">{{__('lang.to_city')}}</label>
                                            <div class="col-12">
                                                <input type="text" disabled class="form-control"
                                                       value='{{$place->to_transite_city}}'
                                                       id="to_transite_place">
                                            </div>

                                        </div>
                                        <div style='width:20px; height:30px; margin-top: 43px;' onclick="window.location.href='{{url(route('admin.delete_transite' , $place->id))}}'"
                                             class='btn btn-primary  btn-sm' ><i
                                                class='ri-delete-bin-line fs-16'></i></div>


                                @endforeach
                                </div>

                            </div>
                        @endif


                        <div class="col-12">
                            <a class="btn btn-soft-dark rounded-pill px-3 text-primary border-primary"
                               onclick="addTransitePlace()">add extra transites</a>
                        </div>


                        <div class="row" id="transite_div">

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
    </div>






@endsection
@section('scripts')
    <script>

        function submitDeleteRow(id) {
           const rowElement = document.getElementById('transite_form_' + id.toString());
            // rowElement.submit();
            console.log('transite_form_' + id.toString());
        }

        function addTransitePlace() {
            const newDiv =
                "<div class='row d-flex' style='justify-content:center'>" +
                "                            <div class=\"col-md-4\">\n" +
                "                                <label for='from_transite_place' class=' col-form-label'>{{__('lang.from_city')}}</label>\n" +
                "                                <div class=\"col-12\">\n" +
                "                                    <input type=\"text\" name='from_transite_place[]' required class=\"form-control\"\n" +
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

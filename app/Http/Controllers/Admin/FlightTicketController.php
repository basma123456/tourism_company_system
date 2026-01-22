<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\FlightTicketRequest;
use App\Models\Airline;
use App\Models\Client;
use App\Models\FlightTicket;
use App\Models\TransitePlaces;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class FlightTicketController extends Controller
{
    public function index(Request $request)
    {
        Session::forget(['invoicesArr', 'ids' ]);
        $query = FlightTicket::query();
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('ticket_no', 'like', "%" . $request->search . "%")
                    ->orWhere('traveller_name', 'like', "%" . $request->search . "%")
                    ->orWhere('from_city', 'like', "%" . $request->search . "%")
                    ->orWhere('to_city', 'like', "%" . $request->search . "%")
                    ->orWhere('price', $request->search)
                    ->orWhere('airline_com', $request->search)
                    ->orWhere('discount', $request->search);
            });
        }

        if ($request->filled('airline_id')) {
            $query->where('airline_id', $request->airline_id);
        }

        if ($request->filled('from_book_date') || $request->filled('to_book_date')) {
            $from = ($request->from_book_date ?? date('Y-m-d'));
            $to = ($request->to_book_date ?? date('Y-m-d'));
            $query->whereBetween('book_date', [$from, $to]);
        }

        if ($request->filled('from_travel_date') || $request->filled('to_travel_date')) {
            $from = ($request->from_travel_date ?? date('Y-m-d'));
            $to = ($request->to_travel_date ?? date('Y-m-d'));
            $query->whereBetween('travel_date', [$from, $to]);
        }

        if ($request->filled('client')) {
            $query->where('client_id', $request->client);
        }

        $flightTickets = $query->with('airline' , 'client' , 'invoice')->latest()->paginate(config('app.pagination_num'))->appends($request->query());
        $clients = Client::active()->select('id', 'name')->get();
        $airlines = Airline::select('id', 'name')->get();

        return view('admin/flight_tickets/index', compact('flightTickets', 'clients', 'airlines'));
    }


    public function create(Request $request)
    {
        $clients = Client::active()->select('id', 'name')->get();
        $airlines = Airline::select('id', 'name')->get();
        return view('admin/flight_tickets/create', compact('clients', 'airlines'));
    }

    public function store(FlightTicketRequest $flightTicketRequest)
//    public function store(Request $flightTicketRequest)
    {

        $ticket = FlightTicket::create($flightTicketRequest->only(
            'airline_id',
            'traveller_name',
            'from_city',
            'to_city',
            'price',
            'airline_com',
            'additional_fees',
            'book_date',
            'travel_date',
            'client_id',
            'discount',
            'ticket_no'
        )
        )->refresh();

        if(!empty($flightTicketRequest->from_transite_place)) {
            foreach ($flightTicketRequest->from_transite_place as $key => $val) {
                $arr[$key] = ['from_transite_city' => $val, 'to_transite_city' => $flightTicketRequest->to_transite_place[$key], 'flight_ticket_id' => $ticket->id];
            }
        }

        DB::table('transite_places')->insert($arr);
        return redirect(route('admin.flight_tickets.index'))->with(['success' => __('lang.you inserted FlightTicket successfully')]);
    }

    public function edit(FlightTicket $flightTicket)
    {
        $flightTicket->load( 'transitePlaces' );
        $clients = Client::active()->select('id', 'name')->get();
        $airlines = Airline::select('id', 'name')->get();
        return view('admin/flight_tickets/edit', compact('flightTicket', 'clients' , 'airlines'));
    }

    public function update(FlightTicketRequest $flightTicketRequest, FlightTicket $flightTicket)
    {
        $flightTicket->update($flightTicketRequest->only(
            'airline_id',
            'traveller_name',
            'from_city',
            'to_city',
            'price',
            'airline_com',
            'additional_fees',
            'book_date',
            'travel_date',
            'client_id',
            'discount',
            'ticket_no'
        )
        );

        if(!empty($flightTicketRequest->from_transite_place)) {
            foreach ($flightTicketRequest->from_transite_place as $key => $val) {
                $arr[$key] = ['from_transite_city' => $val??null , 'to_transite_city' => $flightTicketRequest->to_transite_place[$key]??null ];
            }
            $flightTicket->transitePlaces()->createMany($arr);

        }
        return redirect()->back()->with(['success' => __('lang.FlightTicket has been updated successfully')]);
    }


    public function destroy(FlightTicket $flightTicket)
    {
        if(!$flightTicket){
            return redirect()->back();
        }
        $flightTicket->transitePlaces()->delete();
        $flightTicket->delete();
        return redirect(route('admin.flight_tickets.index'))->with(['success' => 'lang.you have deleted FlightTicket successfully']);
    }


    public function deleteTransite(Request $request , $transite_id)
    {
        $transite =TransitePlaces::find($transite_id);
        if(!$transite){
            return redirect()->back();
        }
        $transite->delete();
        return redirect()->back()->with(['success' => 'lang.you have deleted  FlightTicket successfully']);

    }


    //  used in ajax for print data
    public function getAllData(Request $request)
    {
        $query = FlightTicket::query();
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('ticket_no', 'like', "%" . $request->search . "%")
                    ->orWhere('traveller_name', 'like', "%" . $request->search . "%")
                    ->orWhere('from_city', 'like', "%" . $request->search . "%")
                    ->orWhere('to_city', 'like', "%" . $request->search . "%")
                    ->orWhere('price', $request->search)
                    ->orWhere('airline_com', $request->search)
                    ->orWhere('discount', $request->search);
            });
        }

        if ($request->filled('airline_id')) {
            $query->where('airline_id', $request->airline_id);
        }

        if ($request->filled('from_book_date') || $request->filled('to_book_date')) {
            $from = ($request->from_book_date ?? date('Y-m-d'));
            $to = ($request->to_book_date ?? date('Y-m-d'));
            $query->whereBetween('book_date', [$from, $to]);
        }

        if ($request->filled('from_travel_date') || $request->filled('to_travel_date')) {
            $from = ($request->from_travel_date ?? date('Y-m-d'));
            $to = ($request->to_travel_date ?? date('Y-m-d'));
            $query->whereBetween('travel_date', [$from, $to]);
        }

        if ($request->filled('client')) {
            $query->where('client_id', $request->client);
        }

        $flightTickets = $query->with('airline' , 'client' , 'invoice')->latest()->get();
//        $clients = Client::active()->select('id', 'name')->get();
//        $airlines = Airline::select('id', 'name')->get();

        return view('admin.flight_tickets.print', compact('flightTickets', 'clients', 'airlines'));

    }


    //  used in ajax for print data
    public function getAllDataPrint(Request $request)
    {
        $query = FlightTicket::query();
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('ticket_no', 'like', "%" . $request->search . "%")
                    ->orWhere('traveller_name', 'like', "%" . $request->search . "%")
                    ->orWhere('from_city', 'like', "%" . $request->search . "%")
                    ->orWhere('to_city', 'like', "%" . $request->search . "%")
                    ->orWhere('price', $request->search)
                    ->orWhere('airline_com', $request->search)
                    ->orWhere('discount', $request->search);
            });
        }

        if ($request->filled('airline_id')) {
            $query->where('airline_id', $request->airline_id);
        }

        if ($request->filled('from_book_date') || $request->filled('to_book_date')) {
            $from = ($request->from_book_date ?? date('Y-m-d'));
            $to = ($request->to_book_date ?? date('Y-m-d'));
            $query->whereBetween('book_date', [$from, $to]);
        }

        if ($request->filled('from_travel_date') || $request->filled('to_travel_date')) {
            $from = ($request->from_travel_date ?? date('Y-m-d'));
            $to = ($request->to_travel_date ?? date('Y-m-d'));
            $query->whereBetween('travel_date', [$from, $to]);
        }

        if ($request->filled('client')) {
            $query->where('client_id', $request->client);
        }

        $flightTickets = $query->with('airline' , 'client' , 'invoice')->latest()->get();

        return view('admin.flight_tickets.print', compact('flightTickets'));

    }


}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FlightTicket;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class InvoiceController extends Controller
{
//    public function generateInvoice(Request $request)
//    {
//         if (!empty($request->ids)) {
//            $tickets = FlightTicket::whereIn('id' , $request->ids)->get();
//            $clients = $tickets->pluck('client_id');
//            foreach ($clients as $key => $item){
//                if($key > 0  &&  $clients[$key-1] != $clients[$key]   ){
//                    return redirect()->back()->with('error' , 'client must be the same ');
//                }
//            }
//        }
//    }
    public function index(Request $request)
    {
//        $invoices = Invoice::with('invoiceItems' , 'client')->latest()->paginate(config('app.admin_pagination_number'));
        $invoices = Invoice::with('invoiceItems' , 'client')->latest()->paginate(config('app.pagination_num'))->appends($request->query());

        return view('admin/invoices/index' , compact('invoices'));
    }


    public function generateInvoice(Request $request)
    {

        $request->validate([
            'ids' => ['required', 'array', 'min:1'],
            'ids.*' => ['integer', 'exists:ma_flight_tickets,id'],
        ]);

        $flightTicketQuery = FlightTicket::with('airline:id,name' , 'client:id,name')->whereIn('id', $request->ids);
        $tickets = $flightTicketQuery->get();
        $amount = $tickets->sum(fn ($t) => ($t->price ?? 0) - (($t->discount ?? 0) + ($t->airline_com ?? 0) + ($t->additional_fees ?? 0)));

        if ($tickets->pluck('client_id')->unique()->count() > 1) {
            return back()->with('error', 'All tickets must belong to the same client.');
        }
        Session::put('ids', $request->ids);

        foreach ($tickets as $key => $item) {

            $invoicesArr[$key]['amounts'] = (($item->price ?? 0) - (($item->discount ?? 0) + ($item->airline_com ?? 0) + ($item->additional_fees ?? 0)));
            $invoicesArr[$key]['inv_id'] = $invoice['id'] ?? null;
            $invoicesArr[$key]['item_id'] = $item->id;
            $invoicesArr[$key]['id'] = '-----------';
            $invoicesArr[$key]['inv_id'] = '-----------';
            $invoicesArr[$key]['ticket_no'] = $item->ticket_no;
            $invoicesArr[$key]['traveller_name'] =  $item->traveller_name;
            $invoicesArr[$key]['travel_date']= $item->travel_date;
            $invoicesArr[$key]['from_city'] = $item->from_city;
            $invoicesArr[$key]['to_city'] =$item->to_city;
            $invoicesArr[$key]['final_amount'] = $item->final_amount;
            $invoicesArr[$key]['book_date'] =$item->book_date;
            $invoicesArr[$key]['airline_name'] =$item->airline->name;
            $invoicesArr[$key]['client_name'] =$item->client->name;
            $invoicesArr[$key]['invoice_item_id'] = $item->invoice_item_id;
            $invoicesArr[$key]['notes'] = $item->notes;
        }


        $invoicesArr[0]['inv_code'] = '--------';
        $invoicesArr[0]['inv_date'] = date('Y-m-d');
        $invoicesArr[0]['invoice_amount'] = $amount;
        $invoicesArr[0]['invoice_tax'] =  (0.15) * ($amount);
        $invoicesArr[0]['invoice_amount'] = $amount;

        Session::put('invoicesArr' , $invoicesArr);
        return redirect()
            ->route('admin.invoices.show')
            ->with('success', 'Invoice generated successfully.');
    }




    public function show(Request $request, $id = null)
    {

// dd(session('invoicesArr'));
        if (is_numeric($id )  &&  $id > 0) {
            $invoice = DB::table('ma_invoices')
                ->join('ma_invoices_items', 'ma_invoices.id', '=', 'ma_invoices_items.inv_id')
                ->join('ma_flight_tickets', 'ma_invoices_items.item_id', '=', 'ma_flight_tickets.id')
                ->join('clients', 'ma_invoices.client_id', '=', 'clients.id')
                ->join('airlines', 'ma_flight_tickets.airline_id', '=', 'airlines.id')
                ->where('ma_invoices.id', $id)
                ->selectRaw("ma_flight_tickets.*  ,
              ( price - (airline_com +  additional_fees +  discount)) AS final_amount,
             ma_invoices.inv_code  ,
             ma_invoices.inv_date , 
             ma_invoices.amount as invoice_amount , 
             ma_invoices.tax as invoice_tax ,
             clients.name as client_name , 
             airlines.name as airline_name , 
             ma_invoices_items.id as invoice_item_id ,
             ma_invoices_items.inv_id , 
             ma_invoices_items.notes  ")->get();

        } else {
            if(!session()->has('invoicesArr')){
                return redirect()->back();
            }
            $invoice= session('invoicesArr');
            $invoice = json_decode(json_encode($invoice));
            $id = null;

        }


        if(($invoice == collect() ) && $invoice->isEmpty()){
            return redirect()->back()->with('error' , __('lang.not_found'));
        } elseif(is_array($invoice)  && $id != null){
            return redirect()->back()->with('error' , __('lang.not_found'));
        }
        return view('admin/invoices/show', compact('invoice'));

    }


    public function update(Request $request, $id)
    {
        if ($id > 0) {
            Invoice::where('id', $id)->update(['inv_date' => $request->date]);
            foreach ($request->invoice_item_id as $key => $val) {
                InvoiceItem::where('id', $val)->update(['notes' => $request->notes[$key]]);
            }
        } else {
            $max = Invoice::max('inv_code') ?? 10000;

            $flightTicketQuery = FlightTicket::whereIn('id', session('ids'));
            $tickets = $flightTicketQuery->get();

            $amount = $tickets->sum(fn ($t) => ($t->price ?? 0) - (($t->discount ?? 0) + ($t->airline_com ?? 0) + ($t->additional_fees ?? 0)));


            $clientId = $tickets->first()->client_id;


            $invoice = Invoice::create([
                'inv_code' => ($max + 1),
                'inv_type' => 'flight_tickets',
                'inv_date' => $request->date,
                'amount' => $amount,
                'tax' => (0.15) * ($amount),
                'client_id' => $clientId,

            ])->refresh();

            $flightTicketQuery->update(['invoice_id' => $invoice->id]);

            foreach ($tickets as $key => $item) {
                $arr[$key]['amounts'] = (($item->price ?? 0) - (($item->discount ?? 0) + ($item->airline_com ?? 0) + ($item->additional_fees ?? 0)));
                $arr[$key]['inv_id'] = $invoice->id;
                $arr[$key]['item_id'] = $item->id;
                $arr[$key]['notes'] = $request->notes[$key];
            }
            if (!empty($arr)) {
                $invoice->invoiceItems()->createMany($arr);
            }

            $id = $invoice->id;
            Session::forget(['invoicesArr', 'ids' ]);
        }


        if($request->list === 'invoices'){
            return redirect(route('admin.invoices.show', $id) . '?list=invoices');
        }
        return redirect(route('admin.invoices.show', $id));

    }


    public function printAndGetData($id)
    {
        $msg =             $invoice = DB::table('ma_invoices')
            ->join('ma_invoices_items', 'ma_invoices.id', '=', 'ma_invoices_items.inv_id')
            ->join('ma_flight_tickets', 'ma_invoices_items.item_id', '=', 'ma_flight_tickets.id')
            ->join('clients', 'ma_invoices.client_id', '=', 'clients.id')
            ->join('airlines', 'ma_flight_tickets.airline_id', '=', 'airlines.id')
            ->where('ma_invoices.id', $id)
            ->selectRaw("ma_flight_tickets.*  ,
              ( price - (airline_com +  additional_fees +  discount)) AS final_amount,
             ma_invoices.inv_code  ,
             ma_invoices.inv_date , 
             ma_invoices.amount as invoice_amount , 
             ma_invoices.tax as invoice_tax ,
             clients.name as client_name , 
             airlines.name as airline_name , 
             ma_invoices_items.id as invoice_item_id ,
             ma_invoices_items.inv_id , 
             ma_invoices_items.notes  ")->get();

        return response()->json($msg);
    }



    //  used in ajax for print list data
    public function getAllData()
    {
        $invoices = Invoice::with('invoiceItems' , 'client')->latest()->get();
        return view('admin.invoices.print', compact('invoices'));

    }

}

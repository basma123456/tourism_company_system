<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FlightTicket;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoiceOldController extends Controller
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


    public function generateInvoice(Request $request)  //chatgpt review
    {

        $max = Invoice::max('inv_code') ?? 10000;
        $request->validate([
            'ids' => ['required', 'array', 'min:1'],
            'ids.*' => ['integer', 'exists:ma_flight_tickets,id'],
        ]);

        $flightTicketQuery = FlightTicket::whereIn('id', $request->ids);
        $tickets = $flightTicketQuery->get();

        $amount = $tickets->sum(fn ($t) => ($t->price ?? 0) - (($t->discount ?? 0) + ($t->airline_com ?? 0) + ($t->additional_fees ?? 0)));

        // Ensure all tickets belong to the same client
        if ($tickets->pluck('client_id')->unique()->count() > 1) {
            return back()->with('error', 'All tickets must belong to the same client.');
        }


        $clientId = $tickets->first()->client_id;


        $invoice = Invoice::create([
            'inv_code' => ($max + 1),
            'inv_type' => 'flight_tickets',
            'inv_date' => null,
            'amount' => $amount,
            'tax' => (0.15) * ($amount),
            'client_id' => $clientId,

        ])->refresh();

        $flightTicketQuery->update(['invoice_id' => $invoice->id]);

        foreach ($tickets as $key => $item) {
            $arr[$key]['amounts'] = (($item->price ?? 0) - (($item->discount ?? 0) + ($item->airline_com ?? 0) + ($item->additional_fees ?? 0)));
            $arr[$key]['inv_id'] = $invoice->id;
            $arr[$key]['item_id'] = $item->id;
        }
        if (!empty($arr)) {
            $invoice->invoiceItems()->createMany($arr);
        }


        return redirect()
            ->route('admin.invoices.show', $invoice->id)
            ->with('success', 'Invoice generated successfully.');
    }

    public function show($id)
    {
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

        return view('admin/invoices/show', compact('invoice'));
    }


    public function update(Request $request, $id)
    {
        Invoice::where('id', $id)->update(['inv_date' => $request->date]);
        foreach ($request->invoice_item_id as $key => $val) {
            InvoiceItem::where('id', $val)->update(['notes' => $request->notes[$key]]);
        }
        return redirect()->back();
    }

}

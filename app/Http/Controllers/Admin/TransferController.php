<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Receipt;
use App\Models\Shift;
use Illuminate\Http\Request;

class TransferController extends Controller
{
    public function index()
    {
        $receipts = Receipt::with('user:id,name', 'account', 'createdBy', 'currencyRelation')->where('posted' , '<>',1)->latest()->paginate(config('app.pagination_num'));
        $shift = Shift::with('admin:id,name')->where(['shift_date' => now()->format('Y-m-d'), 'closed' => 0])->first();
        return view('admin/transfer/index', compact('receipts', 'shift'));
    }


    public function transfer($id)
    {
        $receipt = Receipt::where('id' , $id)->update( ['posted' => 1 ]);
        if(!$receipt){
            return redirect()->back()->with('error' , 'mission is failed');
        }
        return redirect()->back()->with('success' , 'receipt is transfered successfully');
    }

    //  used in ajax for print list data
    public function getAllData()
    {
        $receipts = Receipt::with('user:id,name', 'account', 'createdBy', 'currencyRelation')->where('posted' , '<>',1)->latest()->get();
        return view('admin.receipts.print', compact('receipts'));
    }

 }

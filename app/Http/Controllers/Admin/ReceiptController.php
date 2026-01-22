<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ReceiptRequest;
use App\Http\Traits\ImageTrait;
use App\Models\Account;
use App\Models\Currency;
use App\Models\Receipt;
use App\Models\User;
use Illuminate\Http\Request;
use App\Enums\ReceiptType;
use App\Enums\PayType;

class ReceiptController extends Controller
{
    use ImageTrait;

    public function index(Request $request, $type)
    {
        $receipts = Receipt::with('user:id,name', 'account', 'createdBy', 'currencyRelation')->where('Rtype', $type)->latest()->paginate(config('app.pagination_num'));
        return view('admin/receipts/index', compact('receipts', 'type'));
    }

    public function show($type, $id)
    {
        $receipt = Receipt::findOrFail($id);
        return view('admin/receipts/show', compact('receipt', 'type'));
    }

    public function create(Request $request, $type)
    {
        $rTypes = ReceiptType::cases(); //receipt types
        $payTypes = PayType::cases(); //payment types
        $accounts = Account::with('field')->get();
        $currencies = Currency::get();
         $users = User::get();

        return view('admin/receipts/create', compact('type', 'rTypes', 'payTypes', 'accounts', 'currencies' ,  'users'));
    }

    public function edit($type, $id)
    {
        $rTypes = ReceiptType::cases(); //receipt types
        $payTypes = PayType::cases(); //payment types
        $accounts = Account::get();
        $currencies = Currency::get();
        $receipt = Receipt::findOrFail($id);
        $users = User::get();
        return view('admin/receipts/edit', compact('type', 'rTypes', 'payTypes', 'accounts', 'currencies', 'receipt', 'users'));
    }

    public function store(ReceiptRequest $request, $type)
    {
        $newArr = array_merge( ['by_id' => auth()->id() ] , $request->validated());
        if ($request->pay_file) {
            $file = $this->storeImage( $request ,  '/receipts' , $request->pay_file , 'pay_file' );
            $newArr = array_merge($newArr, ['pay_file' => $file]);
        }

        Receipt::create($newArr);
        return redirect()->back();
    }


    public function update(ReceiptRequest $request, $type, $id)
    {
        $receipt = Receipt::findOrFail($id);

        $newArr = array_merge( ['by_id' => auth()->id() ] , $request->validated());
        if ($request->pay_file) {
            $file = $this->updateImage($request, '/receipts', $request->pay_file, 'pay_file', $receipt);
            $newArr = array_merge($newArr, ['pay_file' => $file]);
        }
        if (!$request->approve) {
            $newArr = array_merge($newArr, ['approve' => 'no']);
        }

        if (!$request->posted) {
            $newArr = array_merge($newArr, ['posted' => 'no']);
        }
        if (!$request->printed) {
            $newArr = array_merge($newArr, ['printed' => 0]);
        }

        $receipt->update($newArr);
        return redirect()->back();
    }



    public function destroy( $type , $id)
    {
        $receipt = Receipt::where(['Rtype'  => $type , 'id' => $id])->firstOrFail();
        $this->deleteImage($receipt , 'pay_file');
        $receipt->delete();
        return redirect()->back()->with('success' , __('item deleted successfully'));
    }

    //  used in ajax for print list data
    public function getAllData($type)
    {
        $receipts = Receipt::with('user:id,name', 'account', 'createdBy', 'currencyRelation')->where('Rtype', $type)->latest()->paginate(config('app.pagination_num'));
         return view('admin.receipts.print', compact('receipts', 'type'));
    }


}

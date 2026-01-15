<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CurrencyRequest;
use App\Models\Currency;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function index(Request $request)
    {
        $query = Currency::query();
        if($request->filled('search')){
            $query->where( function ($q) use ($request){
                $q->where('name' , 'like' , "%" . $request->search . "%")->orWhere('symbol' , 'like' , "%" . $request->search . "%")->orWhere('rate' ,     $request->rate  );
            });
        }
        $currencies = $query->latest()->get();
        return view('admin/currencies/index' , compact('currencies'));
    }



    public function create(Request $request)
    {
        return view('admin/currencies/create' );
    }

    public function store(CurrencyRequest $currencyRequest)
    {
        Currency::create(array_merge($currencyRequest->only('name' , 'symbol' , 'rate') ));
        return redirect(route('admin.currencies.index'))->with(['success' => __('lang.you inserted  currency successfully')]);
    }

    public function edit(Currency $currency)
    {
        return view('admin/currencies/edit' , compact('currency') );
    }

    public function update(CurrencyRequest $currencyRequest , Currency $currency)
    {
        $currency->update( $currencyRequest->only('name' , 'symbol' , 'rate')   );
        return redirect()->back()->with(['success' => __('lang.airline has been updated successfully')]);
    }


    public function destroy( Currency $currency)
    {
        $currency->delete();
        return redirect(route('admin.currencies.index'))->with(['success' => 'lang.you have deleted  company successfully']);
    }

}

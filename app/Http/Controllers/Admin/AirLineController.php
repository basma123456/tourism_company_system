<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AirlineRequest;
use App\Models\Airline;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Enums\ClientTypeEnum;
class AirLineController extends Controller
{
    public function index(Request $request)
    {
//        dd(   Client::first()->ctype->label()
//    );
        $query = Airline::query();
        if($request->filled('search')){
            $query->where( function ($q) use ($request){
                $q->where('name' , 'like' , "%" . $request->search . "%")->orWhere('symbol' , 'like' , "%" . $request->search . "%")->orWhere('code' ,     $request->search  );
            });
        }
        $airlines = $query->latest()->paginate(config('app.pagination_num'))->appends($request->query());
        return view('admin/airlines/index' , compact('airlines'));
    }

    public function create(Request $request)
    {
        return view('admin/airlines/create' );
    }

    public function store(AirlineRequest $airlineRequest)
    {
        Airline::create(array_merge($airlineRequest->only('name' , 'symbol') , ['code' => rand(100000 , 999999)]));
        return redirect(route('admin.airlines.index'))->with(['success' => __('lang.you inserted airline successfully')]);
    }

    public function edit(Airline $airline)
    {
        return view('admin/airlines/edit' , compact('airline') );
    }

    public function update(AirlineRequest $airlineRequest , Airline $airline)
    {
        $airline->update( $airlineRequest->only('name' , 'symbol')   );
        return redirect()->back()->with(['success' => __('lang.airline has been updated successfully')]);
    }


    public function destroy( Airline $airline)
    {
        dd($airline->id);
        $airline->delete();
        return redirect(route('admin.airlines.index'))->with(['success' => 'lang.you have deleted  airline successfully']);
    }




    //  used in ajax for print data
    public function getAllData(Request $request)
    {
        $query = Airline::query();
        if($request->filled('search')){
            $query->where( function ($q) use ($request){
                $q->where('name' , 'like' , "%" . $request->search . "%")->orWhere('symbol' , 'like' , "%" . $request->search . "%")->orWhere('code' ,     $request->search  );
            });
        }
        $airlines = $query->latest()->get();
        return view('admin.airlines.print', compact('airlines'));

    }


}

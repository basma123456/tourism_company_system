<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shift;
use Illuminate\Http\Request;
//basma basma
class ShiftController extends Controller
{
    public function openShiftFunc(Request $request)
    {

        if(!openShift()){
            Shift::create( [
                'user_id' => auth()->id(),
                'shift_date' => now()->format('Y-m-d'),
                'name' => 'shift-' . ( (numOfShiftsOfToday()??0) + 1),
                'closed' => 0,
            ]);
        }

        return redirect()->back()->with('success' , __('lang.shift is opened successfully'));
    }


    public function closeShift(Request $request)
    {

        if(openShift()){
          $shift =  Shift::where( [
                'shift_date' => now()->format('Y-m-d'),
                'closed' => 0,
            ])->first();
          if($shift){
              $shift->closed = 1;
              $shift->save();
          }
        }
        Shift::where('shift_date','<', date('Y-m-d'))->update(['closed' => 1]);  // اغلاق اي يومية مش في نفس اليوم

        return redirect()->back()->with('error' , __('lang.shift is closed successfully'));

    }

}

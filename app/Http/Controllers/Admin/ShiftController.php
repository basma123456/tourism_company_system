<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shift;
use Illuminate\Http\Request;

class ShiftController extends Controller
{
    public function openShift(Request $request)
    {
        if(!checkCurrentShift()){
            Shift::create( [
                'user_id' => auth()->id(),
                'shift_date' => now()->format('Y-m-d'),
                'name' => 'shift-' . ( numOfShiftsOfToday() + 1),
                'closed' => 1,
            ]);
        }

        return redirect()->back()->with('success' , __('lang.shift is opened successfully'));
    }


    public function closeShift(Request $request)
    {
        if(checkCurrentShift()){
          $shift =  Shift::where( [
                'user_id' => auth()->id(),
                'shift_date' => now()->format('Y-m-d'),
                'closed' => 1,
            ])->first();
          if($shift){
              $shift->closed = 0;
              $shift->save();
          }
        }
        dd($shift);
        return redirect()->back()->with('error' , __('lang.shift is closed successfully'));

    }

}

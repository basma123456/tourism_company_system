<?php


use App\Models\Shift;

if (!function_exists('checkCurrentShift')) {
    //check if today has shifts or no to add to its count plus one
    // and this case  if we want to create another shift
    function checkCurrentShift()
    {
        return  Shift::where('shift_date' , now()->format('Y-m-d'))->exists();
    }
}


if (!function_exists('numOfShiftsOfToday')) {

    function numOfShiftsOfToday()
    {
        return  Shift::where('shift_date' , now()->format('Y-m-d'))->count();
    }
}



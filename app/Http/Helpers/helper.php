<?php


use App\Models\Shift;

if (!function_exists('checkCurrentShift')) {

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



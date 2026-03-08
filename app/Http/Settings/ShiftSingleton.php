<?php

namespace App\Http\Settings;

use App\Models\Shift;


class ShiftSingleton
{
    private static $instance;
    private $shift;

    private function __construct()
    {
        // Prevent instantiation
    }

    public static function getInstance()

    {
        if (!self::$instance) {
            self::$instance = new ShiftSingleton();
            self::$instance->loadShiftDatabase();
        }
        return self::$instance;
    }

    private function loadShiftDatabase()
    {
        // Code to retrieve current shift status from the database

        $this->shift = Shift::where([
            'shift_date' => now()->format('Y-m-d'),
            'closed'     => 0,
        ])->exists();


    }

    public function getShiftOpenExists()
    {
        return $this->shift;
    }






}

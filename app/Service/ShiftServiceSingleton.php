<?php
 namespace App\Service;

use App\Models\Shift;

class ShiftServiceSingleton
{
    private static ?ShiftServiceSingleton $instance = null;

    // Prevent direct creation
    private function __construct() {}

    // Prevent cloning
    private function __clone() {}

    // Prevent unserializing
    public function __wakeup() {}

    public static function getInstance(): ShiftServiceSingleton
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function openShift(): bool
    {
        return Shift::where([
            'shift_date' => now()->format('Y-m-d'),
            'closed'     => 0,
        ])->exists();
    }


}

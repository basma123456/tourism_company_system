<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    protected $fillable = [
        'user_id',
        'shift_date',
        'name',
        'closed',
    ];

    protected $casts = [
        'shift_date' => 'date',
        'closed' => 'boolean',
    ];

    public function admin()
    {
        return $this->belongsTo(User::class , 'user_id');
    }
}

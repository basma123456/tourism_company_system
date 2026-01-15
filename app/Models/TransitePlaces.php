<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransitePlaces extends Model
{

    protected $table = 'transite_places';

    protected $fillable = [
        'flight_ticket_id',
        'from_transite_city',
        'to_transite_city',
    ];


    public function flightTicket()
    {
      return $this->belongsTo(FlightTicket::class , 'flight_ticket_id');
    }
}

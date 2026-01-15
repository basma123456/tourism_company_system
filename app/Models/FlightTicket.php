<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FlightTicket extends Model
{
    protected $table = 'ma_flight_tickets';

    protected $fillable = [
        'id',
        'airline_id',
        'ticket_no',
        'traveller_name',
        'from_city',
        'to_city',
        'price',
        'airline_com',
        'additional_fees',
        'book_date',
        'travel_date',
        'client_id',
        'invoice_id',
        'discount',
    ];

    public function transitePlaces()
    {
        return $this->hasMany(TransitePlaces::class , 'flight_ticket_id');
    }

    public function client(){
        return $this->belongsTo(Client::class , 'client_id');
    }
    public function airline(){
        return $this->belongsTo(Airline::class , 'airline_id');
    }

    public function invoice()
    {
     return $this->belongsTo(Invoice::class , 'invoice_id');
    }

}

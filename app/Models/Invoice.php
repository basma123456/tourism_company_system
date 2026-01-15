<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = 'ma_invoices';
    protected $fillable = [
        'inv_code',
        'inv_type',
        'inv_date',
        'amount',
        'tax',
        'client_id',

    ];

    public function invoiceItems()
    {
        return $this->hasMany(InvoiceItem::class , 'inv_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class , 'client_id');
    }
}

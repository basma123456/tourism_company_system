<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{

    protected $table = 'ma_invoices_items';
    protected $fillable = [
        'inv_id',
        'item_id',
        'amounts',
        'notes'];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class , 'inv_id');
    }

}

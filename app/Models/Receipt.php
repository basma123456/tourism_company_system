<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Enums\ReceiptType;
use App\Enums\PayType;

class Receipt extends Model
{
    protected $fillable = [
        'Rtype',
        'amount',
        'currency',
        'name',
        'notes',
        'pay_type',
        'pay_file',
        'shift_id',
        'acc_id',
        'acc_detail_type',
        'acc_details_id',
        'approve',
        'approve_note',
        'printed',
        'posted',
        'Rcreated_date',
        'by_id',
    ];


    protected $casts = [
        'Rtype'         => ReceiptType::class,
        'pay_type'      => PayType::class,
//        'approve'       => ApproveStatus::class,
        'amount'        => 'decimal:2',
        'printed'       => 'boolean',
//        'posted'        => 'boolean',
        'Rcreated_date' => 'datetime',
    ];


    protected $attributes = [
        'approve' => 'no',
        'printed' => false,
        'posted'  => 'no',
    ];



    public function scopeIn($query)
    {
        return $query->where('Rtype', 'in');
    }

    public function scopeOut($query)
    {
        return $query->where('Rtype', 'out');
    }

    public function scopeApproved($query)
    {
        return $query->where('approve', 'yes');
    }
    public function scopeNotApproved($query)
    {
        return $query->where('approve', 'no');
    }


    public function scopePosted($query)
    {
        return $query->where('posted', 'yes');
    }

    public function scopeNotPosted($query)
    {
        return $query->where('posted', 'no');
    }


    public function scopeCash($query)
    {
        return $query->where('pay_type', 'cash');
    }

    public function scopeTransfer($query)
    {
        return $query->where('pay_type', 'transfer');
    }


    public function getDateAttribute()
    {
       return $this->Rcreated_date ?  $this->Rcreated_date->format('Y-m-d') : '';
    }



    public function account()
    {
        return $this->belongsTo(Account::class, 'acc_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'by_id');
    }

    public function currencyRelation()
    {
        return $this->belongsTo(Currency::class, 'currency');
    }

    public function user()
    {
     return $this->belongsTo(User::class , 'by_id')  ;
    }
}

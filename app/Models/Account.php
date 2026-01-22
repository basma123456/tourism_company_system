<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
 protected $table='ma_accounts';
 protected $primaryKey ='accountid';

    public function field()
    {
        return $this->belongsTo(CompanyField::class , 'field_id' );
 }
}

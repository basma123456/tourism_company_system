<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyField extends Model
{
    protected $table='ma_company_fields';

    protected $fillable = [
      'name',
      'active',
    ];
}

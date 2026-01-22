<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\TourismFileTypesEnum;

class TourismFile extends Model
{
    protected $table = 'ma_tourism_files';


    protected $fillable = [
        'Fcode',
        'Ftype',
        'Fname',
        'emp',
        'adults_no',
        'child_no',
        'infants_no',
        'arrival_date',
        'leave_date',
        'nationality',
        'created_date',
        'closed',
        'approved',
    ];

//    public function casts(): array
//    {
//        return [
//            'Ftype' =>  TourismFileTypesEnum::class,
//        ];
//
//    }
//
    public function country()
    {
        return $this->belongsTo(Country::class , 'nationality');
    }

    public function getArrivalDateOnlyAttribute()
    {
        return  date_create($this->arrival_date)->format('Y-m-d');
    }

    public function getLeaveDateOnlyAttribute()
    {
        return  date_create($this->leave_date)->format('Y-m-d');
    }

    public function getCreatedDateOnlyAttribute()
    {
        return  date_create($this->created_date)->format('Y-m-d');
    }

    public function type()
    {
        return $this->belongsTo(CompanyField::class , 'Ftype');
    }

}

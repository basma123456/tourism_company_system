<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Enums\ClientTypeEnum;

class Client extends Model
{
    protected $fillable =[
        'code'  ,
	 	'name'	 ,
	 	'phone'	 ,
	 	'email'	 	,
	 	'address'	,
	 	'active'	,
	 	'person_res',
	 	'ctype'	,
//        enum('indv', 'org')

    ];






    protected function casts(): array
    {
        return [
            'ctype' =>  ClientTypeEnum::class,
        ];
    }


    public function scopeActive($query)
    {
        return $this->where('active' , 1);
    }

}

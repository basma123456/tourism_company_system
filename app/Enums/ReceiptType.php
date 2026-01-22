<?php

namespace App\Enums;

enum ReceiptType : string
{
case
    IN = 'in';
case
    OUT = 'out';


    public
    function label(): string
    {
        return match($this){
        self::IN => __('lang.in'),
        self::OUT => __('lang.out'),
         };
    }

}

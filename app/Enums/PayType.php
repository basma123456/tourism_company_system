<?php

namespace App\Enums;

enum PayType : string
{
case
    CASH = 'cash';

case
    TRANSFER = 'transfer';

case
    CHECK = 'check';

    public
    function label(): string
    {
        return match($this){
        self::TRANSFER => __('lang.transfer'),
        self::CASH => __('lang.cash'),
        self::CHECK => __('lang.check'),
        };
    }

}

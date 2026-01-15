<?php

namespace App\Enums;

enum ClientTypeEnum : string
{
case
    INDIVIDUAL = 'invd';
case
    ORGANIZATION = 'org';


    public
    function label(): string
    {
        return match($this){
        self::INDIVIDUAL => __('lang.individual'),
            self::ORGANIZATION => __('lang.org'),
        };
    }


}


<?php

namespace App\Enums;

enum TourismFileTypesEnum : string
{

case HAJJ = 'hajj';
case UMRAH = 'umrah';
case DOMESTIC_TOURISM = 'domestic_tourism';
case EXTERNAL_TOURISM = 'external_tourism';


    public
    function label(): string
    {
        return match($this){
            self::HAJJ => __('lang.hajj'),
            self::UMRAH => __('lang.umrah'),
            self::DOMESTIC_TOURISM => __('lang.domestic_tourism'),
            self::EXTERNAL_TOURISM => __('lang.external_tourism'),
        };
    }


}

<?php

namespace zkrat\BasicPower\Helpers\Filter;


use zkrat\BasicPower\template\TemplateConstats;
use \DateTime;


class CzDate
{

    /**
     * @param DateTime $dateTime
     * @return DateTime
     */
    public function __invoke(DateTime $dateTime=null):?string
    {
        if($dateTime instanceof DateTime){
            return $dateTime->format(TemplateConstats::DATE);
        }
        return null;

    }
}
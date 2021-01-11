<?php


namespace zkrat\BasicPower\Helpers\Filter;


use Nette\Utils\DateTime;
use zkrat\BasicPower\template\TemplateConstats;

class CzDateTime
{


    /**
     * @param DateTime $dateTime
     * @return mixed
     */
    public function __invoke($dateTime)
    {
        if (is_string($dateTime))
            $dateTime=DateTime::createFromFormat('Y-m-d H:i:s',$dateTime);
        return $dateTime->format(TemplateConstats::DATE_TIME);
    }
}
<?php


namespace zkrat\BasicPower\Helpers;


use Nette\Utils\DateTime;

class HelperDateTime
{
    const DATE_US = 'Y-m-d';
    const TIME24 = 'G:i';

    public static function numberToText($num, $text_0='dnes', $text_1='dnem', $text_2_4='dny', $text_5='dny') {

        if($num<0)
            $text_5='dnů';
        $num = abs($num);
        $str = ($num>0) ? $num. ' ': '';


        return $str . (abs($num) == 1 ? $text_1 :
                ($num==0 ? $text_0 :( abs($num) >= 5 ? $text_5 : $text_2_4)));
    }



    public static function createDate($string):?DateTime
    {
        $list=count_chars($string, 1);
        $num=ord('.');
        if (isset($list[$num]) &&$list[$num]==2){
            list($day,$month,$year) = explode('.', $string,3);
            $day=intval($day);
            $month=intval($month);
            $year=intval($year);

            if (is_numeric($day)&&is_numeric($month)&&is_numeric($year)){
                $dateStr=$day.'.'.$month.'.'.$year;
                $dateTime = DateTime::createFromFormat('j.n.Y H:i:s', $dateStr.' 00:00:00');
                if ($dateStr==$dateTime->format('j.n.Y') || $dateStr==$dateTime->format('j.m.Y')){
                    return $dateTime;
                }
            }
        }


        return NULL;

    }

    public static function createDateOrNow($date=null):DateTime{
        $datetime=self::createDate($date);
        if(is_null($datetime))
            $datetime= new DateTime();
        return $datetime;

    }

    public static function sortDateTimes(DateTime &$minDate, DateTime &$maxDate){
        if ($minDate<$maxDate){
            $to_date2=$maxDate;
            $maxDate=$minDate;
            $minDate=$to_date2;
        }

    }

}
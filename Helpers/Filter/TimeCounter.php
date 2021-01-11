<?php


namespace zkrat\BasicPower\Helpers\Filter;



class TimeCounter
{





    private static function convertTimeToString($value,$core){
        $return='';
        if($value==1)
            $return =$value.' '.$core.'u';
        elseif ($value>1 && $value<5)
            $return =$value.' '.$core.'y';
        elseif ($value>4)
            $return =$value.' '.$core;
        return $return;
    }

    private static function strReplaceFirst($from, $to, $content)
    {
        $from = '/'.preg_quote($from, '/').'/';

        return preg_replace($from, $to, $content, 1);
    }


    /**
     * @param $seconds
     * @return string
     */
    public function __invoke($seconds)
    {
        $hours = floor($seconds / 3600);
        $minutes = floor(($seconds / 60) % 60);
        $seconds = $seconds % 60;
        $return=[];

        if($hours>0)
            $return[]=self::convertTimeToString($hours,'hodin');
        if($minutes>0)
            $return[]=self::convertTimeToString($minutes,'minut');
        if($seconds>0)
            $return[]=self::convertTimeToString($seconds,'sekund');
        $str=implode(' a ',$return);
        if(substr_count($str,'a ')>1){
            $str=self::strReplaceFirst(' a ',', ', $str);
        }
        return $str;




    }

}
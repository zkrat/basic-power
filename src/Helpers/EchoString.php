<?php


namespace zkrat\BasicPower\Helper;


class EchoString
{
    private static $isCli;

    private static function isCli() {
        if(is_null(self::$isCli))
            self::$isCli= (php_sapi_name() === 'cli');

        return self::$isCli;

    }


    public static function writeLn(string $string) {
        if (self::isCli())
            echo $string.PHP_EOL;
        else
            echo $string.'<br>';
    }
}
EchoString::writeLn('ahoj');
<?php


namespace zkrat\BasicPower\Abstracts;


use Helper\HelperString;
use Nette\SmartObject;

abstract class DataRow
{
    use SmartObject;

    protected $parent;

    public function __construct(array $array =[],$parent=null){
        foreach ($array as $key =>$val ){
            $var=HelperString::underscoreToCamelCase($key);
            if (property_exists($this,$var))
                $this->$var =$array[$key];

        }
        $this->parent=$parent;


    }
}
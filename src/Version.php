<?php

namespace zkrat;


class Version{


    /**
     * @var string
     */
    private $verison;

    protected $debug=false;

    /**
     * Version constructor.
     * @param $verisonArray
     */
    public function __construct(array $verisonArray){

        $this->verison = isset($verisonArray['version']) ? $verisonArray['version'] : null;
        $this->debug = isset($verisonArray['debug']) ? $verisonArray['debug'] : false;
    }

    /**
     * @return mixed
     */
    public function getVerison(){
        if($this->debug)
            return $this->verison.'_'.md5(microtime(true));
        return $this->verison;
    }

    public function __toString()
    {
        return $this->getVerison();
    }


}
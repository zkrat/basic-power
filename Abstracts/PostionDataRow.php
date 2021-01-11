<?php


namespace zkrat\BasicPower\Abstracts;



abstract class PostionDataRow extends DataRow{


    /**
     * @var bool
     */
    protected $updatedPosition=false;

    /**t
     * @var
     */
    protected $position;


    public function setPosition($position){
        $this->position = $position;
        $this->updatedPosition=true;
    }

    public function getPosition(){
        return $this->position;
    }

    abstract public function getId();

    /**
     * @return bool
     */
    public function isUpdatedPosition(): bool
    {
        return $this->updatedPosition;
    }


    public function isLast(): bool{
        return $this->parent->isLastId($this->getId());
    }

    public function isFirst(): bool{
        return $this->parent->isFirstId($this->getId());
    }


}
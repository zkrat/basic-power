<?php

namespace zkrat\BasicPower\Abstracts;
use zkrat\BasicPower\Abstracts\Exceptions\DataCollectionException;

trait TraitDataList   {



    protected $data=array();

    protected $fullCount;


    /**
     * Retrieve an external iterator
     * @link http://php.net/manual/en/iteratoraggregate.getiterator.php
     * @return Traversable An instance of an object implementing <b>Iterator</b> or
     * <b>Traversable</b>
     * @since 5.0.0
     */
    public function getIterator(): \Traversable
    {
        return new \RecursiveArrayIterator($this->data);
    }

    /**
     * Whether a offset exists
     * @link http://php.net/manual/en/arrayaccess.offsetexists.php
     * @param mixed $offset <p>
     * An offset to check for.
     * </p>
     * @return boolean true on success or false on failure.
     * </p>
     * <p>
     * The return value will be casted to boolean if non-boolean was returned.
     * @since 5.0.0
     */

    public function offsetExists(mixed $offset): bool
    {
        return isset($this->data[$offset]);
    }

    /**
     * Offset to retrieve
     * @link http://php.net/manual/en/arrayaccess.offsetget.php
     * @param mixed $offset <p>
     * The offset to retrieve.
     * </p>
     * @return mixed Can return all value types.
     * @since 5.0.0
     */
    public function offsetGet(mixed $offset): mixed
    {
        return $this->data[$offset];
    }


    public function rowsArray()
    {
        return array_values($this->data);
    }

    /**
     * Offset to set
     * @link http://php.net/manual/en/arrayaccess.offsetset.php
     * @param mixed $offset <p>
     * The offset to assign the value to.
     * </p>
     * @param mixed $value <p>
     * The value to set.
     * </p>
     * @return void
     * @since 5.0.0
     */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        if (!is_scalar($offset)) { // prevents NULL
            throw new DataCollectionException(sprintf('Key must be either a string or an integer, %s given.', gettype($offset)),DataCollectionException::KEY_IS_NOT_SCALAR);
        }
        $this->data[$offset] = $value;
    }

    /**
     * Offset to unset
     * @link http://php.net/manual/en/arrayaccess.offsetunset.php
     * @param mixed $offset <p>
     * The offset to unset.
     * </p>
     * @return void
     * @since 5.0.0
     */
    public function offsetUnset(mixed $offset): void
    {
        unset($this->data[$offset]);
    }

    /**
     * Count elements of an object
     * @link http://php.net/manual/en/countable.count.php
     * @return int The custom count as an integer.
     * </p>
     * <p>
     * The return value is cast to an integer.
     * @since 5.1.0
     */
    public function count():int
    {
        return count($this->data);
    }


    public function firstItem(){
        foreach ($this->data as $item)
            return $item;

        throw new DataCollectionException('Collection is empty ',DataCollectionException::COLLECTION_EMPTY);
    }

    public function first(int $num=1){

        if ($this->count()<=$num)
            return $this->data;

        $array=[];
        foreach ($this->data as $key => $obj){
            $array[$key]=$obj;
            $num--;
            if($num<1)
                break;
        }
        return $array;
    }
    public function revert(){
        $this->data=array_reverse($this->data,TRUE);
    }

    /**
     * @return mixed
     */
    public function getFullCount()
    {
        return $this->fullCount;
    }

    /**
     * @param mixed $fullCount
     */
    public function setFullCount($fullCount): void
    {
        $this->fullCount = $fullCount;
    }




    public function isEmpty(  ) {
        return count($this->data)==0;
    }

    public function __get($name)
    {
        return $this->$name;
    }

}
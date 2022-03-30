<?php

namespace zkrat\BasicPower\Abstracts;

use zkrat\BasicPower\Abstracts\Exceptions\DataCollectionException;


abstract class DataList  extends \stdClass implements \ArrayAccess, \Countable, \IteratorAggregate{


    use TraitDataList;

}

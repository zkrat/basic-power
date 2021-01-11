<?php


namespace zkrat\BasicPower\Abstracts;


use Models\ObjectContent\TestContentRow;

abstract class PostionDataList extends DataList{


    protected $firstId;

    protected $lastId;


    protected $postion=0;


    protected $dataPositionMissing=[];


    protected $dataPosition=[];



    protected function specifyPostion(PostionDataRow $postionDataRow){
        if(is_null($this->firstId))
            $this->firstId=$postionDataRow->getId();

        $this->lastId=$postionDataRow->getId();
        $this->updatePostion($postionDataRow);

    }


    /**
     * @return array
     */
    public function getDataPosition(): array
    {
        return $this->dataPosition;
    }

    /**
     * @return array
     */
    public function getDataPositionMissing(): array
    {
        return $this->dataPositionMissing;
    }


    private function updatePostion(PostionDataRow  $postionDataRow){

        if(is_null($postionDataRow->getPosition())){
            $postionDataRow->setPosition(++$this->postion);
            $this->dataPositionMissing[$postionDataRow->getId()]=$postionDataRow;
        }

        if(!isset($this->dataPosition[$postionDataRow->getPosition()])){
            $this->dataPosition[$postionDataRow->getPosition()]=$postionDataRow;
        }else{
            $this->postion= max(array_keys($this->dataPosition));
            $postionDataRow->setPosition(++$this->postion);
            $this->dataPosition[$postionDataRow->getPosition()]=$postionDataRow;
            $this->dataPositionMissing[$postionDataRow->getId()]=$postionDataRow;
        }
    }


    public function getPostionDataRowById($postionDataId):PostionDataRow{
        return $this->data[$postionDataId];
    }

    public function hasPostionDataRowById($postionDataId):bool{
        return isset($this->data[$postionDataId]) && $this->data[$postionDataId] instanceOf PostionDataRow;
    }

    public function getPrevPostionDataRowById($testPostionId):PostionDataRow {
        $keys =array_keys($this->data);
        $keyId = array_search($testPostionId, $keys)-1;
        if(isset($keys[$keyId]) && isset($this->data[$keys[$keyId]]))
            return $this->data[$keys[$keyId]];
        return $this->data[$testPostionId];;
    }

    public function getNextPostionDataRowById($testPostionId):PostionDataRow {
        $keys =array_keys($this->data);
        $keyId = array_search($testPostionId, $keys)+1;
        if(isset($keys[$keyId]) && isset($this->data[$keys[$keyId]]))
            return $this->data[$keys[$keyId]];
        return $this->data[$testPostionId];
    }





    /**
     * @return mixed
     */
    public function getLastId()
    {
        return $this->lastId;
    }


    /**
     * @return mixed
     */
    public function getFirstId()
    {
        return $this->firstId;
    }


    public function isFirstId($id):bool
    {
        return $this->firstId==$id;
    }


    public function isLastId($id):bool
    {
        return $this->lastId==$id;
    }
}
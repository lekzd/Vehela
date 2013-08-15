<?php

abstract Class ActiveRecord{

    protected $_dbObj;
    protected $tableName;

    public function __construct(){}

    public function save(){

        if(!$this->IsItNewRecord()){

            $class_vars = get_class_vars(get_class($this));
            unset($class_vars['tableName']);


            $query = "UPDATE {$this->tableName} SET ";
            unset($this->tableName);

            foreach($this as $key => $value){
                if($key<>'id' and $key<>'_dbObj')
                    $query .= "{$key} = '{$value}', ";
            }

            $query = substr($query,0,strlen($query)-2);
            $query .= " where id = {$this->id}";

        }

        else {

            foreach($this as $key => $value){
                if($key<>'tableName' and $key<>'_dbObj')
                    $Record[$key]=$this->$key;
            }

            $query = "INSERT INTO {$this->tableName} (";
            $columns = null;
            $values = null;

            unset($Record['id']);

            foreach($Record as $column => $value){
                if($key<>'id'){
                    $columns .= "{$column}, ";
                    $values .= "'{$value}', ";
                }

            }

            $query .= $columns;
            $query = substr($query,0,strlen($query)-2);
            $query .= ') VALUES (';

            $query .= $values;
            $query = substr($query,0,strlen($query)-2);
            $query .= ')';


        }

        $this->_dbObj->query($query);

    }

    public function deleteById($id){
        if(Registry::get('QuickPass'))
            Registry::get('DBQueue')->add(array(
                'table'=>$this->tableName,
                'function'=>'deleteById',
                'query'=>"DELETE FROM {$this->tableName} where id = $id"
            ));
        /*
        $this->_dbObj->query("DELETE from {$this->tableName} where id = $id");*/
    }

    public function getById($id,$force = null){

        $id = intval($id);
        if($force == null){

            if(Registry::get('QuickPass')) {
                Registry::get('DBQueue')->add(array(
                    'table'=>$this->tableName,
                    'function'=>'getById',
                    'query'=>"SELECT * FROM {$this->tableName} where id = $id"
                ));
                return 1;
            }
            else {
                $DBQueue = Registry::get('DBQueue');
                if(empty($DBQueue->results[$this->tableName]['getById'][$id]))
                    return null;
                else{
                    $modelName = get_class($this);
                    $record = $this->FillRecord(new $modelName(),$DBQueue->results[$this->tableName]['getById'][$id]);
                    return $record;
                }

            }

        }

        else
        {

            $Record = $this->_dbObj->query("SELECT * FROM {$this->tableName} where id = $id");
            $Record = $Record->fetch(PDO::FETCH_ASSOC);


            var_dump($Record);
            die();
            $modelName = get_class($this);
            $Record = $this->FillRecord(new $modelName(),$Record);
            return $Record;


        }


    }

    public function getAll($limit = null, $force = null){

        if(Registry::get('QuickPass')){

            if(!is_null($limit))
                $limit = 'limit '.$limit;

            if($force == null)
                Registry::get('DBQueue')->add(array(
                    'table'=>$this->tableName,
                    'function'=>'getAll',
                    'query'=>"SELECT * FROM {$this->tableName} desc $limit"
                ));

            else {
                $Records = $this->_dbObj->query("SELECT * FROM {$this->tableName} $limit");
                $Records = $Records->fetchAll(PDO::FETCH_CLASS);
                return $Records;
            }

        }

        else {

            $DBQueue = Registry::get('DBQueue');
            return $DBQueue->results[$this->tableName]['getAll'];

        }

    }

    protected function IsItNewRecord(){

        if(!empty($this->id)){
            $Record = $this->_dbObj->query("SELECT count(*) FROM {$this->tableName} where id = {$this->id}");
            $Record = $Record->fetch(PDO::FETCH_ASSOC);
            return !intval($Record["count(*)"]);
        }

        else
            return 1;


    }

    protected function FillRecord($record,$data){

        if(!$data)
            return null;

        foreach($data as $key => $value){
            $record->$key = $value;
        }

        return $record;

    }


}



?>
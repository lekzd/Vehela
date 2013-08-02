<?php

require_once('database/CRUD.php');

abstract class Model extends CRUD
{

    private $_dbObj;
    private $TableName;

    public function __construct()
    {
        $this->_dbObj = Registry::get('DB');
    }

    public function getTableName()
    {
        return $this->TableName;
    }

    public function getByPk()
    {
        
    }

}

?>
<?php

require_once('database/CRUD.php');

abstract class Model extends CRUD
{

    private $Connection;
    private $TableName;

    public function __construct($Connection)
    {
        $this->Connection = &$Connection;
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
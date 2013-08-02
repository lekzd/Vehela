<?php

require_once('database/CRUD.php');

abstract class Model extends CRUD
{

    public function __construct()
    {
        $this->_dbObj = Registry::get('DB');
    }


}

?>
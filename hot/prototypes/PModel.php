<?php

require_once('database/CRUD.php');

abstract class PModel extends CRUD
{

    public function __construct()
    {
        $this->_dbObj = Registry::get('DB');
    }


}

?>
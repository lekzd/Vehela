<?php

require_once('database/CRUD.php');

abstract class PModel extends CRUD
{

    public function __construct()
    {
        if(is_null(Registry::get('DB')))
            Registry::add('DB', new PDataBase(Vehela::$_SETTINGS['DataBase']));

        $this->_dbObj = Registry::get('DB');
    }


}

?>
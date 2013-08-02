<?php

class Users extends Model
{

    public $email;
    public $password;
    private $tableName = 'Users';

    public function getTableName()
    {
        return $this->tableName;
    }
    
}

?>
<?php

require_once('ActiveRecord.php');

abstract class CRUD extends ActiveRecord
{

    public function Create()
    {
        echo 'creating';
    }

    public function Retrieve()
    {
        echo 'retrieving';
    }

    public function Update()
    {
        echo 'updating';
    }

    public function Delete()
    {
        echo 'deleting';
    }

}

?>
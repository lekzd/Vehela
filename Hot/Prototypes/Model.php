<?php

    require_once('DataBase/CRUD.php');

    Abstract Class Model extends CRUD{

        private $Connection;
        private $TableName;

        public function __construct($Connection){
            $this->Connection = &$Connection;
        }

        public function getTableName(){
            return $this->TableName;
        }

        public function getByPk(){

        }

    }



?>
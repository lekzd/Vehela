<?php

    Class DataBase {

        public $host;
        public $user;
        public $password;
        public $db;

        private $Settings;

        public function __construct($Settings){

            foreach($Settings as $key => $Parameter){
                $this->$key = $Parameter;
            }

            $this->Connect();

        }

        public function Connect(){
            mysql_connect($this->host,$this->user,$this->password) or die(mysql_error());
        }


    }



?>
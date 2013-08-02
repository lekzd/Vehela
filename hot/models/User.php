<?php

    class User extends PModel
    {

        public $id;
        public $login;
        public $email;
        public $pass_salt;
        public $pass_hash;
        protected $tableName = 'user';



    }

?>

    
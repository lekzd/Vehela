<?php

    Class Users extends Model{

        public $Email;
        public $Password;

        private $TableName = 'Users';

        public function getTableName(){
            return $this->TableName;
        }

    }



?>
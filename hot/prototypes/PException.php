<?php

    Class PException extends Exception {

        public function __construct($Message){
            echo $Message;
            die();
        }

    }



?>
<?php

    Class RegisterController extends Controller {

        public function Start(){

            require_once('/../../Models/Users.php');
            $Users = new Users($this->DBConnection);

            die();
            $this->MakeStampInLayout('PageName','Регистрация');
        }

        public function beforeDestruct(){
            die();
        }

    }



?>
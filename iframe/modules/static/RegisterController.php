<?php

class RegisterController extends PController
{

    public function Start()
    {
        require_once('/../../Models/Users.php');
        $Users = new Users($this->DBConnection);

        //die();
        $this->MakeStampInLayout('PageName', 'Регистрация');
    }

    public function beforeDestruct()
    {
        die();
    }

    public function checkLogin($login)
    {
        
    }
    
    public function checkEmail($email)
    {
        
    }

}

?>
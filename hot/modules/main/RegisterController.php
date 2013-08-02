<?php

class RegisterController extends Controller
{

    public function Start()
    {
        require_once('/../../models/Users.php');
        $Users = new Users();

        die();
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
<?php

class WelcomeController extends PController
{
    public function Init(){}
	
    public function Hello()
    {

        $this->AddBreadcrumb(
            'Главная',
            ''
        );

        $this->MakeStampInLayout('Title', 'Главная');


        $User = Vehela::Model('User')->getById(53,1);

        $User->pass_salt = 'developer';
        $User->pass_hash = md5('pass'.$User->pass_salt);
        $User->save();
        die();

        $this->PutIntoObjects($User);

    }

    public function beforeDestruct(){
        //die();
    }

}

?>
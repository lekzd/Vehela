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


        $Bimka = phpFastCache::get("Bimka");
        phpFastCache::$storage = "auto";

        if($Bimka == null) {

            $Bimka = Vehela::Model('User')->getById(52);

            if(!Registry::get('QuickPass')){
                phpFastCache::set("Bimka",$Bimka,60);
            }

        }

        $this->PutIntoObjects($Bimka);

    }

    public function beforeDestruct(){
        //die();
    }

}

?>
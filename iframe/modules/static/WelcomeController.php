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

        $this->PutIntoObjects($User);

    }

    public function AjaxGettingData(){

        if(Tools::IsAjaxRequest()){

            echo "Data loaded from Ajax";

        }

        die();

    }

    public function beforeDestruct(){
        //die();
    }

}

?>
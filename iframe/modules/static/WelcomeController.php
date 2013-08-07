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

        $User = Vehela::Model('User')->getById(2);
        $User2 = Vehela::Model('User')->getById(40);
        
        //var_dump($User);		
		$this->dump($User);
        //$dump_func($User);
        $this->PutIntoObjects($User);
        $this->PutIntoObjects($User2,'$User2');
    }

    public function beforeDestruct(){
        //die();
    }

}

?>
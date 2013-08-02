<?php

class WelcomeController extends PController
{

    public function Init()
    {
        
    }

    public function Hello()
    {
        $this->MakeStampInLayout('Title', 'Главная');
        $this->MakeStampInLayout('PageName', 'Главная страница');

        $User = Vehela::Model('User');

    }

}

?>
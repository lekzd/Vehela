<?php

class WelcomeController extends PController
{

    public function Init()
    {
        
    }

    public function Hello()
    {

        $this->AddBreadcrumb(
            'Команда',
            ''
        );

        $this->MakeStampInLayout('Title', 'Главная');

        $User = Vehela::Model('User');
    }

}

?>
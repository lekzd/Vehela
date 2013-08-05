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
<<<<<<< HEAD

=======
        $this->MakeStampInLayout('PageName', 'Главная страница');
>>>>>>> 6ef0fb57bec5b80d1de07181673c64dc3a74a01a
        $User = Vehela::Model('User');
    }

}

?>
<?php

class WelcomeController extends Controller
{

    public function Init()
    {
        
    }

    public function Hello()
    {
        $this->MakeStampInLayout('Title', 'Главная');
        $this->MakeStampInLayout('PageName', 'Главная страница');
        $this->Render->RenderView('hello');

        $User = Vehela::Model('Users');

    }

}

?>
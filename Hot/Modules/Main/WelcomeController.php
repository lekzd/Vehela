<?php

class WelcomeController extends Controller
{

    public function Init()
    {
        
    }

    public function Hello()
    {
        $this->MakeStampInView('test', 'hello');
        $this->MakeStampInLayout('Title', 'Главная');
        $this->MakeStampInLayout('PageName', 'Главная страница');
    }

}

?>
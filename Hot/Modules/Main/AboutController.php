<?php

class AboutController extends Controller
{

    public function Init()
    {
        
    }

    public function Show()
    {
        $this->MakeStampInLayout('Title', 'О проекте');
        $this->MakeStampInLayout('PageName', 'О проекте');
    }

}

?>
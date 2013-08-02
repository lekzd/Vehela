<?php

    Class InfoController extends Controller{


        public function about(){
            $this->MakeStampInLayout('Title', 'О проекте');
            $this->MakeStampInLayout('PageName', 'О проекте');
            $this->Render->RenderView('about');
        }

        public function team(){
            $this->MakeStampInLayout('Title', 'Vehela.team');
            $this->MakeStampInLayout('PageName', 'Vehela.team');
            $this->Render->RenderView('team');
        }

        public function beforeDestruct(){
            //die();
        }

    }




?>
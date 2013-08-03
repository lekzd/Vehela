<?php

    Class InfoController extends PController{


        public function about(){
            $this->MakeStampInLayout('Title', 'О проекте');
            $this->MakeStampInLayout('PageName', 'О проекте');
        }

        public function team(){
            $this->MakeStampInLayout('Title', 'Vehela.team');
            $this->MakeStampInLayout('PageName', 'Vehela.team');
        }

        public function debug(){
            $this->MakeStampInLayout('Title', '<#Debug#>');
            $this->MakeStampInLayout('PageName', '<#Debug#>');
        }

        public function beforeDestruct(){
            //die();
        }

    }




?>
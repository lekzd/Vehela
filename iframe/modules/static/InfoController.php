<?php

    Class InfoController extends PController{


        public function about(){

            $this->AddBreadcrumb(
                'О Vehela',
                ''
            );

            $this->MakeStampInLayout('Title', 'О Vehela');
        }

        public function team(){

            $this->AddBreadcrumb(
                'Команда',
                ''
            );

            $this->MakeStampInLayout('Title', 'Команда');
            $this->MakeStampInLayout('PageName', 'Команда');
        }

        public function debug(){

            $this->AddBreadcrumb(
                '<#Debug#>',
                ''
            );

            $this->MakeStampInLayout('Title', '<#Debug#>');
            $this->MakeStampInLayout('PageName', '<#Debug#>');
        }

        public function beforeDestruct(){
            //die();
        }

    }




?>
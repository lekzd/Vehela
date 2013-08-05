<?php

    Class InfoController extends PController{


        public function about(){
<<<<<<< HEAD

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

=======
            $this->MakeStampInLayout('Title', 'О проекте');
            $this->MakeStampInLayout('PageName', 'О проекте');
        }

        public function team(){
            $this->MakeStampInLayout('Title', 'Vehela.team');
            $this->MakeStampInLayout('PageName', 'Vehela.team');
        }

        public function debug(){
>>>>>>> 6ef0fb57bec5b80d1de07181673c64dc3a74a01a
            $this->MakeStampInLayout('Title', '<#Debug#>');
            $this->MakeStampInLayout('PageName', '<#Debug#>');
        }

        public function beforeDestruct(){
            //die();
        }

    }




?>
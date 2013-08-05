<?php

    Class DebugController extends PController {

<<<<<<< HEAD
        public function Init(){

        }

        public function Classes(){

            $this->AddBreadcrumb(
                '<#Debug#>',
                'index.php?module=static&controller=info&action=debug'
            );

            $this->AddBreadcrumb(
                'Проверка классов',
                ''
            );

=======
        public function Classes(){

>>>>>>> 6ef0fb57bec5b80d1de07181673c64dc3a74a01a
            $this->MakeStampInLayout('Title', '<#Debug#>');
            $this->MakeStampInLayout('PageName', '<#Debug#>');
            $this->MakeStampInLayout('RequestMethod', Vehela::RequestMethod());

            if(!empty($_GET['class']))
            {
<<<<<<< HEAD
                $methods = get_class_methods($_GET['class']);
                $this->PutIntoObjects('methods', $methods);
=======
                $this->MakeStampInLayout('Test', array('test','te'));
            }
            else {

>>>>>>> 6ef0fb57bec5b80d1de07181673c64dc3a74a01a
            }

            if(Vehela::RequestMethod()=='POST'){
                header("location:index.php?module=static&controller=debug&action=classes&class={$_POST['ClassName']}");
            }

        }



    }
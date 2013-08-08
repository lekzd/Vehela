<?php

    Class DebugController extends PController {

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

            $this->MakeStampInLayout('Title', '<#Debug#>');
            $this->MakeStampInLayout('PageName', '<#Debug#>');
            $this->MakeStampInLayout('RequestMethod', Vehela::RequestMethod());

            if(!empty($_GET['class']))
            {
                $methods = get_class_methods($_GET['class']);
                $this->PutIntoObjects($methods,'methods');
            }

            if(Vehela::RequestMethod()=='POST'){
                header("location:index.php?module=static&controller=debug&action=classes&class={$_POST['ClassName']}");
            }

        }



    }
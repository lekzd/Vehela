<?php

    Class DebugController extends PController {

        public function Classes(){

            $this->MakeStampInLayout('Title', '<#Debug#>');
            $this->MakeStampInLayout('PageName', '<#Debug#>');
            $this->MakeStampInLayout('RequestMethod', Vehela::RequestMethod());

            if(!empty($_GET['class']))
            {
                $this->MakeStampInLayout('Test', array('test','te'));
            }
            else {

            }

            if(Vehela::RequestMethod()=='POST'){
                header("location:index.php?module=static&controller=debug&action=classes&class={$_POST['ClassName']}");
            }

        }



    }
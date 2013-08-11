<?php

     Class HStartingSystem {

        private $Vehela;

        public function HStartingSystem(&$Vehela){
            $this->Vehela = &$Vehela;
        }

        public function HandleSettingsArray($_SETTINGS){
            foreach ($_SETTINGS as $key => $value) {
                $this->Vehela->_SETTINGS[$key] = $value;
            }
        }

    }





?>
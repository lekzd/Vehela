<?php

    Class HController {

        CONST RequestedModuleIsAPI = 1;
        CONST RequestedModuleIsNotAPI = 0;

        public function HController(&$Vehela){
            $this->LaunchDbSystem();
            $this->RecognizeRequestedModule($Vehela);
        }

        private function LaunchDbSystem(){
            Tools::LoadDataBaseClasses();
            Registry::add('DBQueue',new DBQueue());
        }

        private function RecognizeRequestedModule(&$Vehela){

            if($this->IsAPIRequest()){
                require_once('/../../prototypes/PAPIController.php');
                require_once('/../../modules/main/APIController.php');
                $this->CreateControllerObject($Vehela->_SETTINGS);
                $ActionName = Registry::get('Router')->Action;
                if(method_exists(Registry::get('Controller'),$ActionName))
                    Registry::get('Controller')->$ActionName();
                else
                    throw new PException('Action not found',404);
            }
            else{

                require_once(Vehela::RootDir.'/prototypes/PController.php');
                $this->IncludeController();
                $this->CreateControllerObject($Vehela->_SETTINGS);

            }
        }

        private function IsAPIRequest(){

            if(Registry::get('Router')->Controller == 'api')
                return 1;

            else
                return 0;

        }

        private function IncludeController()
        {
            require_once(Vehela::RootDir .'/../iframe/modules/' . Registry::get('Router')->Module . '/' . Registry::get('Router')->Controller . 'Controller.php');
        }

        private function CreateControllerObject($settings)
        {
            $this->ControllerName = Registry::get('Router')->Controller . 'Controller';
            Registry::add('Controller', new $this->ControllerName($settings));
        }





    }



?>
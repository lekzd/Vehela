<?php

    require_once(Vehela::RootDir.'/helpers/systems/HStartingSystem.php');


    Class StartingSystem {

        private $HStartingSystem;

        public function __construct(&$Vehela){
            $this->HStartingSystem = new HStartingSystem($Vehela);
            $this->LoadSettings($Vehela);
            $this->LoadCoreClasses($Vehela);
            $this->LoadErrorHanlder();
            $this->LoadLocalization($Vehela->_SETTINGS['language']);
            $this->LoadPlugins($Vehela);
        }

        private function LoadSettings()
        {
            $_SETTINGS = array();
            require_once(Vehela::RootDir.'/settings.php');
            $this->HStartingSystem->HandleSettingsArray($_SETTINGS);
        }

        private function LoadCoreClasses()
        {
            require_once('Registry.php');
            require_once('Tools.php');
            require_once('TestErrorHandler.php');
            require_once(Vehela::RootDir.'/prototypes/PException.php');
        }

        private function LoadErrorHanlder(){
            Tools::LoadErrorHanlder($this);
        }

        private function LoadLocalization($localizationName){
            
        }

        private function LoadPlugins(&$Vehela){
            foreach($Vehela->_SETTINGS['Plugins']['Preload'] as $name => $plugin_info){
                require_once(Vehela::RootDir.'/plugins/'.$plugin_info['path']);
            }
        }


    }

?>
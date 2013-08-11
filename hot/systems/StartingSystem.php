<?php

    require_once('/../helpers/systems/HStartingSystem.php');

    Class StartingSystem {

        private $HStartingSystem;

        public function __construct(&$Vehela){
            $this->HStartingSystem = new HStartingSystem($Vehela);
            $this->LoadSettings($Vehela);
            $this->LoadCoreClasses();
            $this->LoadErrorHanlder();
            $this->LoadPlugins($Vehela);
        }

        private function LoadSettings()
        {
            $_SETTINGS = array();
            require_once('/../settings.php');
            $this->HStartingSystem->HandleSettingsArray($_SETTINGS);
        }

        private function LoadCoreClasses()
        {
            require_once('Registry.php');
            require_once('Tools.php');
            require_once('TestErrorHandler.php');
            require_once('/../prototypes/PException.php');
        }

        private function LoadErrorHanlder(){
            Tools::LoadErrorHanlder($this);
        }

        private function LoadPlugins(&$Vehela){
            foreach($Vehela->_SETTINGS['Plugins']['Preload'] as $name => $plugin_info){
                require_once(Vehela::RootDir.'/plugins/'.$plugin_info['path']);
            }
        }


    }

?>
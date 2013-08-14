<?php

    class StartingSystem {

        public function __construct(){
            $this->LoadSettings();
            $this->LoadCoreClasses();
            $this->LoadErrorHanlder();
            $this->LoadLocalization(Vehela::$_SETTINGS['language']);
            $this->LoadPlugins();
        }

        private function LoadSettings()
        {
            $_SETTINGS = [];
            require_once(Vehela::RootDir.'/settings.php');
            Vehela::$_SETTINGS = $_SETTINGS;
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

        private function LoadPlugins(){
            foreach(Vehela::$_SETTINGS['Plugins']['Preload'] as $name => $plugin_info){
                require_once(Vehela::RootDir.'/plugins/'.$plugin_info['path']);
            }
        }


    }

?>
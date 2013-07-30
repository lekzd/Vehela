<?php

    Class Render {

        private $Module;
        private $Controller;
        private $Action;
        public $Views;

        public function __construct($Module, $Controller, $Action){
            $this->Module = $Module;
            $this->Controller = $Controller;
            $this->Action = $Action;
            $this->Views = $this->Init();
        }

        private function Init(){

            $layout = $this->getLayout();
            $view = $this->getTemplate($this->Module);
            $view = str_replace('{$view}','view',$view);

            $layout = str_replace('{$ModuleName}',$this->Router->ModuleName,$layout);
            $layout = str_replace('{$Content}',$view,$layout);

            return $layout;

        }

        public function getLayout() {
            return $this->getTplFile("/../../static/templates/main/layout");
        }

        public function getTemplate() {

            if(empty($this->Module))
                $this->Module = 'main';

            if(empty($this->Controller))
                $this->Controller = 'welcome';

            if(empty($this->Action))
                $this->Action = 'hello';

            return $this->getTplFile("/../../static/templates/{$this->Module}/{$this->Controller}");
        }

        private function getTplFile($location){
            ob_start();
            include ("{$location}.tpl");
            $tpl = ob_get_clean();
            return $tpl;
        }

    }





?>
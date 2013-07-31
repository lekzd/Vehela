<?php

    Class Render {

        private $Module;
        private $Controller;
        private $Action;
        public $Layout;
        public $View;

        public function __construct($Module, $Controller, $Action){
            $this->Module = $Module;
            $this->Controller = $Controller;
            $this->Action = $Action;
            $this->Init();
        }

        private function Init(){

            $this->Layout = $this->getLayout();
            $this->View = $this->getTemplate($this->Module);
            $this->View = str_replace('{$view}','view',$this->View);

            $this->Layout = str_replace('{$ModuleName}',$this->Router->ModuleName,$this->Layout);
            //$this->Layout = str_replace('{$Content}',$this->View,$this->Layout);

            $ret = array();
            $ret['Layout'] = $this->Layout;
            $ret['View'] = $this->View;

            return $ret;

        }

        public function getLayout() {
            return $this->getTplFile("/../../static/templates/default/layout");
        }

        public function getTemplate() {
            $this->IsRequestForMainPage();
            return $this->getTplFile("/../../static/templates/default/modules/{$this->Module}/{$this->Controller}");
        }

        private function getTplFile($location){
            ob_start();
            include ("{$location}.tpl");
            $tpl = ob_get_clean();
            return $tpl;
        }

        private function IsRequestForMainPage(){

            if(empty($this->Module))
                $this->Module = 'main';

            if(empty($this->Controller))
                $this->Controller = 'welcome';

            if(empty($this->Action))
                $this->Action = 'hello';

        }

    }





?>
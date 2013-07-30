<?php

    Abstract Class Controller {

        protected $View;

        public function __construct($View){
            $this->View = $View;
            $this->Init();
        }

        public function __destruct(){
            $this->Render();
        }

        public function Init(){
        }

        public function Render(){
            $this->View->View = str_replace('{$Content}','test',$this->View->View);
            $this->View->Layout = str_replace('{$Content}',$this->View->View,$this->View->Layout);
            print($this->View->Layout);
        }

        public function MakeStampInView($VariableName, $Value){
            $this->View->View = str_replace('{$'.$VariableName.'}',$Value,$this->View->View);
        }

        public function MakeStampInLayout($VariableName, $Value){
            $this->View->Layout = str_replace('{$'.$VariableName.'}',$Value,$this->View->Layout);
        }

    }





?>
<?php

    Abstract Class Controller {

        protected $View;

        public function __construct($View){
            $this->View = $View;
            $this->Init();
            //$this->Render($View);
        }

        public function Init(){

        }

        public function Render($View){
            print($View->Views);
        }

    }





?>
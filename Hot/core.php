<?php

   Class Core {

       private $_SETTINGS;
       private $Render;
       private $Router;
       private $Start_time;

       public function __construct(){
            $this->StartCalculate();
            $this->Init();
       }

       public function __destruct(){
           $this->EndCalculate();
       }

       private function Init(){
            $this->LoadSettings();
            $this->Router = $this->InitRouterSystem();

            $this->Render->view = $this->InitRenderingSystem();

            $this->InitController($this->Render->view);
       }

       private function LoadSettings(){

           $_SETTINGS = array();

           require_once('settings.php');

           foreach($_SETTINGS as $key=>$value){
               $this->_SETTINGS["$key"] = $value;
           }

       }

       private function InitRouterSystem(){
            require_once('Systems/Router.php');
            return new Router();
       }

       private function InitRenderingSystem(){
           require_once('Systems/Render.php');
           return new Render($this->Router->Module,$this->Router->Controller,$this->Router->Action);
       }

       private function InitController($View){
           require_once('Prototypes/Controller.php');
           require_once('Modules/'.$this->Router->Module.'/'.$this->Router->Controller.'Controller.php');
           $ConrollerName = $this->Router->Controller.'Controller';
           $Controller = new $ConrollerName($View);
           $ActionName = $this->Router->Action;
           $Controller->$ActionName();
       }

       private function StartCalculate(){
           $start_time = microtime();
           $start_array = explode(" ",$start_time);
           $this->Start_time = $start_array[1] + $start_array[0];
       }

       private function EndCalculate(){
           $end_time = microtime();
           $end_array = explode(" ",$end_time);
           $end_time = $end_array[1] + $end_array[0];
           $time = $end_time - $this->Start_time;
           printf("Страница сгенерирована за %f секунд",$time);
       }


   }



?>
<?php

class Vehela
{

    private $_SETTINGS;
    private $Render;
    private $Router;
    private $Controller;
    private $ControllerName;
    private $start_time;
    private $DBConnection;
    const RootDir = __DIR__;

    public function __construct()
    {
        $this->StartCalculate();
        $this->Init();
    }

    public function __destruct()
    {
        $this->EndCalculate();
    }

    private function Init()
    {
        $this->LoadSettings();
        //$this->LoadDataBaseClasses();
        $this->LoadCoreClasses();
        $this->Router = $this->InitRouterSystem();
        $this->Render = $this->InitRenderingSystem();
        //$this->DBConnection = new DataBase($this->_SETTINGS['DataBase']);
        $this->InitController($this->Render);
    }

    private function LoadSettings()
    {
        $_SETTINGS = array();

        require_once('Settings.php');

        foreach ($_SETTINGS as $key => $value) {
            $this->_SETTINGS[$key] = $value;
        }
    }

    private function LoadCoreClasses()
    {
        require_once('systems/Tools.php');
    }

    private function LoadDataBaseClasses()
    {
        require_once('prototypes/DataBase.php');
        require_once('prototypes/Model.php');
    }

    private function InitRouterSystem()
    {
        require_once('systems/Router.php');
        return new Router();
    }

    private function InitRenderingSystem()
    {
        require_once('systems/Render.php');
        return new Render($this->Router->Module, $this->Router->Controller, $this->Router->Action);
    }

    private function InitController($View)
    {
        $this->IncludeController();
        $this->CreateControllerObject($View);
        $this->CallControllerFunction();
    }

    private function IncludeController()
    {
        require_once('prototypes/Controller.php');
        require_once('Modules/' . ucfirst($this->Router->Module) . '/' . ucfirst($this->Router->Controller) . 'Controller.php');
    }

    private function CreateControllerObject($View)
    {
        $this->ControllerName = $this->Router->Controller . 'Controller';
        $this->Controller = new $this->ControllerName($this->DBConnection, $View);
    }

    private function CallControllerFunction()
    {
        $ActionName = $this->Router->Action;
        $this->Controller->$ActionName();
    }

    private function StartCalculate()
    {
        $this->start_time = microtime(true);
    }

    private function EndCalculate()
    {
        $time = microtime(true) - $this->start_time;
        printf("<div class='debug_generation_time'>Страница сгенерирована за %f секунд.<br/> Использовано %s</div>", $time, $this->convert(memory_get_usage(true)));
    }

    private function convert($size)
    {
        $unit = array('b', 'kb', 'mb', 'gb', 'tb', 'pb');
        return @round($size / pow(1024, ($i = floor(log($size, 1024)))), 2) . ' ' . $unit[$i];
    }

    public static function Model($ModelName){

        if(!Tools::checkForIncluded("Model"))
            Tools::includeFile(Vehela::RootDir."/prototypes/Model.php");

        if(!Tools::checkForIncluded($ModelName))
            Tools::includeFile(Vehela::RootDir."/models/{$ModelName}.php");

        $Model = new $ModelName('oups');

        return $Model;
    }



}

?>
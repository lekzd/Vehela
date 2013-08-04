<?php

class Vehela
{

    private $_SETTINGS;
    private $Render;
    private $Router;
    private $Controller;
    private $ControllerName;
    private $start_time;
    private $error;
    const RootDir = __DIR__;

    public function __construct()
    {
        $this->StartCalculate();
        $this->Init();
    }

    public function __destruct()
    {
        if(Registry::get('Router')->Controller != 'api')
            Registry::get('Controller')->TransferGenerationTime($this->EndCalculate());
    }

    private function Init()
    {
        $this->LoadSettings();
        $this->LoadDataBaseClasses();
        $this->LoadCoreClasses();
        $this->LoadErrorHanlder();
        $this->InitRouterSystem();
        $this->InitController();
        $this->InitRenderingSystem();

    }

    private function LoadSettings()
    {
        $_SETTINGS = array();

        require_once('settings.php');

        foreach ($_SETTINGS as $key => $value) {
            $this->_SETTINGS[$key] = $value;
        }
    }

    private function LoadCoreClasses()
    {
        require_once('systems/Registry.php');
        require_once('systems/Tools.php');
        require_once('systems/TestErrorHandler.php');
        require_once('prototypes/PException.php');
    }

    private function LoadErrorHanlder(){
        $this->error = new TestErrorHandler;
        set_error_handler( array( $this->error, 'execute' ) );
    }

    private function LoadDataBaseClasses()
    {
        require_once('prototypes/PDataBase.php');
        require_once('prototypes/PModel.php');
    }

    private function InitRouterSystem()
    {
        require_once('systems/Router.php');
        Registry::add('Router',new Router());
    }

    private function InitRenderingSystem()
    {
        require_once('systems/Render.php');
        Registry::add('Render', new Render(Registry::get('Router')));
    }

    private function InitController()
    {

        if($this->IsAPIRequest()){
            require_once('prototypes/PAPIController.php');
            require_once('modules/main/APIController.php');
            $this->CreateControllerObject();
            $ActionName = Registry::get('Router')->Action;
            if(method_exists(Registry::get('Controller'),$ActionName))
                Registry::get('Controller')->$ActionName();
            else
                throw new PException('Action not found',404);
        }
        else{
            require_once('prototypes/PController.php');
            $this->IncludeController();
            $this->CreateControllerObject();
            $this->CheckNeedlessDataBase();
            $this->CallControllerFunction();
        }

        //Registry::add('DB', new PDataBase($this->_SETTINGS['DataBase']));

    }

    private function IncludeController()
    {
        require_once('/../iframe/modules/' . Registry::get('Router')->Module . '/' . Registry::get('Router')->Controller . 'Controller.php');
    }

    private function CreateControllerObject()
    {
        $this->ControllerName = Registry::get('Router')->Controller . 'Controller';
        Registry::add('Controller', new $this->ControllerName(Registry::get('Router')));
    }

    private function CheckNeedlessDataBase(){
        $this->IsRequestedStaticModule();
    }

    private function CallControllerFunction()
    {
        Registry::get('Controller')->CallAction(Registry::get('Router')->Action);
    }

    private function StartCalculate()
    {
        $this->start_time = microtime(true);
    }

    private function EndCalculate()
    {
        $time = microtime(true) - $this->start_time;
        return $time;
   }

    private function IsAPIRequest(){

        if(Registry::get('Router')->Controller == 'api')
            return 1;

        else
            return 0;

    }

    private function IsRequestedStaticModule(){
        if(Registry::get('Router')->Module=='static')
            return 1;
        else
            return 0;
    }

    public static function Model($ModelName)
    {
        if (!Tools::checkForIncluded('Model'))
            Tools::includeFile(self::RootDir . '/prototypes/PModel.php');

        if (!Tools::checkForIncluded($ModelName))
            Tools::includeFile(self::RootDir . "/models/{$ModelName}.php");

        $Model = new $ModelName('oups');

        return $Model;
    }

    public static function RequestMethod(){
        return $_SERVER['REQUEST_METHOD'];
    }
}

?>
<?php

class Vehela
{

    private $_SETTINGS;
    private $Render;
    private $Router;
    private $DBQueue;
    private $ControllerName;
    private $start_time;
    public $error;
    public $QuickPass = true;
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
        $this->LoadCoreClasses();
        $this->LoadErrorHanlder();
        $this->LoadPlugins();
        $this->InitRouterSystem();
        $this->GoQuickPass();
        $this->InitRenderingSystem();
        $this->InitController($this->_SETTINGS);
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
        Tools::LoadErrorHanlder($this);
    }

    private function InitRouterSystem()
    {
        require_once('systems/Router.php');
        Registry::add('Router',new Router());
    }

    private function GoQuickPass(){
        Registry::add('QuickPass',$this->QuickPass);
        $this->InitController($this->_SETTINGS);
        Registry::del('Controller');
        Registry::del('QuickPass');
        $this->QuickPass = 0;
        Registry::add('QuickPass',$this->QuickPass);
    }

    private function InitRenderingSystem()
    {
        require_once('systems/Render.php');
        Registry::add('Render', new Render());
    }

    private function LoadPlugins(){
        foreach($this->_SETTINGS['Plugins'] as $name => $plugin_info){
            require_once(self::RootDir.'/plugins/'.$plugin_info['path']);
        }
    }

    private function InitController($settings)
    {

        Tools::LoadDataBaseClasses();
        Registry::add('DBQueue',new DBQueue());

        if($this->IsAPIRequest()){
            require_once('prototypes/PAPIController.php');
            require_once('modules/main/APIController.php');
            $this->CreateControllerObject($settings);
            $ActionName = Registry::get('Router')->Action;
            if(method_exists(Registry::get('Controller'),$ActionName))
                Registry::get('Controller')->$ActionName();
            else
                throw new PException('Action not found',404);
        }
        else{

            require_once('prototypes/PController.php');
            $this->IncludeController();
            $this->CreateControllerObject($settings);
            $this->CheckNeedlessDataBase();

        }

    }

    private function IncludeController()
    {
        require_once(self::RootDir .'/../iframe/modules/' . Registry::get('Router')->Module . '/' . Registry::get('Router')->Controller . 'Controller.php');
    }

    private function CreateControllerObject($settings)
    {
        $this->ControllerName = Registry::get('Router')->Controller . 'Controller';
        Registry::add('Controller', new $this->ControllerName($settings));
    }

    private function CheckNeedlessDataBase(){
        $this->IsRequestedStaticModule();
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

        if (!Tools::checkForIncluded($ModelName))
            Tools::includeFile(self::RootDir . "/../iframe/models/{$ModelName}.php");


        $Model = new $ModelName('oups');

        return $Model;
    }

    public static function RequestMethod(){
        return $_SERVER['REQUEST_METHOD'];
    }

}

?>

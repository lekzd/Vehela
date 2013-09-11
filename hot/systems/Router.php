<?php

Class Router
{

    public $Method;
    public $Module;
    public $ModuleName;
    public $Controller;
    public $Action;

    public function __construct()
    {
        $this->Init();
    }

    private function Init()
    {
        $this->MatchURLRoutes();

        $this->ParseRequest();
        $this->RequestMethod();
    }

    private function ParseRequest()
    {
        if (!$this->IsEmptyRequest()) {
            $this->RecognizeModule();
            $this->RecognizeController();
            $this->RecognizeAction();
        } else
            $this->DefineRequestAsDefaultPage();
    }

    private function RequestMethod()
    {
        $this->Method = $_SERVER['REQUEST_METHOD'];
    }

    private function RecognizeModule()
    {
        $this->Module = $_GET['module'];
        $this->ModuleName = $this->RecognizeModuleName($this->Module);
        unset($_GET['module']);
    }

    private function RecognizeController()
    {
        $this->Controller = $_GET['controller'];
        unset($_GET['controller']);
    }

    private function RecognizeAction()
    {
        $this->Action = $_GET['action'];
        unset($_GET['action']);
    }

    private function RecognizeModuleName($module)
    {
        $modules = array(
            'static' => 'Информация',
            'main' => 'Главная страница',
        );

        foreach ($modules as $key => $ModuleName) {
            if ($key == $module)
                return $ModuleName;
        }
    }

    private function IsEmptyRequest()
    {
        if (empty($_GET['module']) && empty($_GET['controller']) && empty($_GET['action']))
            return 1;
    }

    private function DefineRequestAsDefaultPage()
    {
        $this->Module = 'static';
        $this->Controller = 'welcome';
        $this->Action = 'hello';
    }

    private function MatchURLRoutes() 
    {   
        $settings = Vehela::$_SETTINGS;  
        $url = $_SERVER['REQUEST_URI'];

        if ( empty($settings['URLRoutes']) ) {
            return false;
        }

        $routes_list = $settings['URLRoutes'];

        foreach ($routes_list as $route_item) {
            if ( $route_item['match'] == $url ) {

                $_GET['module']     = $route_item['module'];
                $_GET['controller'] = $route_item['controller'];
                $_GET['action']     = $route_item['action'];

                break;
            }
        }
        
    }

}

?>

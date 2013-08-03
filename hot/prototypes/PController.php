<?php

abstract class PController
{

    protected $_dbObj;
    protected $Router;
    public $Render;

    public function __construct($Router)
    {
        $this->_dbObj = Registry::get('DB');

        $this->Router = &$Router;

        if (method_exists($this, 'beforeInit'))
            $this->beforeInit();

        $this->Init();
    }

    public function __destruct()
    {
        if (method_exists($this, 'beforeDestruct'))
            $this->beforeDestruct();

        Registry::get('Render')->CompileLayout();
        print(Registry::get('Render')->Layout);
    }

    public function Init()
    {
    }

    public function beforeInit()
    {
        
    }

    public function beforeDestruct()
    {
        
    }

    public function MakeStampInLayout($VariableName, $Value)
    {
        $this->Render->Layout['variables'][$VariableName] = $Value;
    }

    public function CallAction($ActionName){
        if(method_exists($this,$ActionName))
            $this->$ActionName();
    }

    public function RenderPage(){

    }
}

?>

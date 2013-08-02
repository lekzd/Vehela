<?php

abstract class Controller
{

    protected $View;
    protected $_dbObj;
    protected $Router;
    protected $Render;

    public function __construct($Router, $Render, $View)
    {
        $this->_dbObj = Registry::get('DB');

        $this->Router = &$Router;
        $this->Render = &$Render;

        if (method_exists($this, 'beforeInit'))
            $this->beforeInit();

        $this->View = $View;
        $this->Init();
    }

    public function __destruct()
    {
        if (method_exists($this, 'beforeDestruct'))
            $this->beforeDestruct();

        $this->Render->RenderLayout($this->Render);
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
        $this->View->Layout['variables'][$VariableName] = $Value;
    }

}

?>

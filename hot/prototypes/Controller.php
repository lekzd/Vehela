<?php

abstract class Controller
{

    protected $View;
    protected $DBConnection;
    protected $Router;
    protected $Render;

    public function __construct($DBConnection, $Router, $Render, $View)
    {
        $this->DBConnection = &$DBConnection;

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
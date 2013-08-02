<?php

abstract class Controller
{

    protected $View;
    protected $_dbObj;

    public function __construct($View)
    {
        $this->_dbObj = Registry::get('DB');
        if (method_exists($this, 'beforeInit'))
            $this->beforeInit();

        $this->View = $View;
        $this->Init();
    }

    public function __destruct()
    {
        if (method_exists($this, 'beforeDestruct'))
            $this->beforeDestruct();

        $this->Render();
    }

    public function Init()
    {
        
    }

    public function Render()
    {
        $this->View->View = str_replace('{$Content}', 'test', $this->View->View);
        $this->View->Layout = str_replace('{$Content}', $this->View->View, $this->View->Layout);
        print($this->View->Layout);
    }

    public function MakeStampInView($VariableName, $Value)
    {
        $this->View->View = str_replace('{$' . $VariableName . '}', $Value, $this->View->View);
    }

    public function MakeStampInLayout($VariableName, $Value)
    {
        $this->View->Layout = str_replace('{$' . $VariableName . '}', $Value, $this->View->Layout);
    }

    public function beforeInit()
    {
        
    }

    public function beforeDestruct()
    {
        
    }

}

?>
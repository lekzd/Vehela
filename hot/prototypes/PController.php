<?php

abstract class PController
{

    protected $_dbObj;
    protected $Router;
    public $Objects = array();
    public $Render;
    public $Breadcrumbs = array();

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

    public function PutIntoObjects($ItemName,$Item){
        $this->Objects[$ItemName] = $Item;
    }

    public function TransferGenerationTime($time){
        printf("<div class=\"debug_generation_time\">Страница сгенерирована за %f секунд.<br/> Использовано %s</div>", $time, $this->convert(memory_get_usage(true)));
    }

    public function AddBreadcrumb($title, $url){

        $this->Breadcrumbs[] = array(
            'title'=>$title,
            'url'=>$url
        );

    }

    private function convert($size)
    {
        $unit = array('b', 'kb', 'mb', 'gb', 'tb', 'pb');
        return @round($size / pow(1024, ($i = floor(log($size, 1024)))), 2) . ' ' . $unit[$i];
    }


}

?>

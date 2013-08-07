<?php

abstract class PController
{

    protected $_dbObj;
    protected $Router;
    protected $Settings;
    public $dump_func='_empty';
    public $Objects = array();
    public $Render;
    public $Breadcrumbs = array();

    public function __construct($settings)
    {
        $this->_dbObj = Registry::get('DB');
        $this->Settings = &$settings;

        $this->Router = Registry::get('Router');

        if (method_exists($this, 'beforeInit'))
            $this->beforeInit();

        $this->Init();

        $ActionName = $this->Router->Action;

        if (method_exists($this, $ActionName)){

            if(Registry::get('QuickPass')!=true)
                $this->dump_func="var_dump";

            $this->$ActionName();

        }

        if(Registry::get('QuickPass')==true){

            if(sizeof(Registry::get('DBQueue')->queries)!=0){
                Registry::add('DB', new PDataBase($this->Settings['DataBase']));
                Registry::get('DBQueue')->ExecuteRequests();
                Registry::get('DBQueue')->ClearQueries();
            }

        }

    }

    public function __destruct()
    {
        if (method_exists($this, 'beforeDestruct'))
            $this->beforeDestruct();

        if(!Registry::get('QuickPass')){
            Registry::get('Render')->CompileLayout();
            print(Registry::get('Render')->Layout);
        }
    }

    public function Init(){}

    public function beforeInit(){}

    public function beforeDestruct(){}

    public function MakeStampInLayout($VariableName, $Value)
    {
        $this->Render->Layout['variables'][$VariableName] = $Value;
    }

    public function CallAction($ActionName){
        if(method_exists($this,$ActionName))
            $this->$ActionName();
    }

    public function PutIntoObjects($Item){

        if(!Registry::get('QuickPass')){
            $this->Objects["{$Item}"] = $Item;
        }
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

    public function _empty($args){}
	
	public function var_dump($arg)
	{
		var_dump($arg);
	}

    public function dump($Arg){
        $function_name = $this->dump_func;
        self::$function_name($Arg);
    }

}

?>

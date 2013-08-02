<?php

Class Render
{

    private $Module;
    private $Controller;
    private $Action;
    public $Layout;
    public $View;

    public function __construct($Module, $Controller, $Action)
    {
        $this->Module = $Module;
        $this->Controller = $Controller;
        $this->Action = $Action;
        $this->Init();
    }

    private function Init()
    {
    }

    public function RenderLayout($Render)
    {

        if(empty($Render->View))
            $Render->View = new ArrayObject();

        if(empty($Render->View->View))
            $Render->View->View = $this->getTplFile($this->Action);

        $Render->View->Layout = str_replace('{$Content}', $Render->View->View, $this->getLayout());

        if(!empty($Render->Layout['variables']))
            foreach($Render->Layout['variables'] as $key => $variable){
                $Render->View->Layout = $this->MakeStampInLayout($Render->View->Layout, $key,$variable);
            }

        print($Render->View->Layout);
    }

    public function RenderView($ViewName){

        if(empty($this->View))
            $this->View = new ArrayObject();

        $this->View->View = $this->getTplFile($ViewName);
    }

    public function MakeStampInLayout($RenderLayout, $VariableName, $Value)
    {
        return str_replace('{$' . $VariableName . '}', $Value, $RenderLayout);
    }

    public function getLayout()
    {
        return $this->getTplFile('../../../layout');
    }

    public function getView($TemplateName)
    {
        $this->IsRequestForMainPage();
        return $this->getTplFile($TemplateName);
    }

    private function getTplFile($TemplateName)
    {

        if(!file_exists(Vehela::RootDir."/../static/templates/default/modules/{$this->Module}/{$this->Controller}/{$TemplateName}.tpl"))
            echo "Файл представления {$TemplateName} не существует ";

        ob_start();
        include (Vehela::RootDir."/../static/templates/default/modules/{$this->Module}/{$this->Controller}/{$TemplateName}.tpl");
        $tpl = ob_get_clean();
        return $tpl;
    }

    private function IsRequestForMainPage()
    {
        if (empty($this->Module))
            $this->Module = 'main';

        if (empty($this->Controller))
            $this->Controller = 'welcome';

        if (empty($this->Action))
            $this->Action = 'hello';
    }
}

?>
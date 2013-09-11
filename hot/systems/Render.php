<?php

class Render
{

    private $Router;
    public $Layout;
    public $View;

    public function __construct()
    {
        $this->Router = Registry::get('Router');
        $this->Init();
    }

    private function Init()
    {
    }

    public function CompileLayout()
    {

        $Render = Registry::get('Controller')->Render;

        $this->View = $this->getTplFile($this->Router->Action);
        $this->Render_debug_string = Registry::get('generation_time');
        $this->Layout = $this->getLayout();

        $this->MakeStampInLayout( 'Content', $this->View );
        $this->MakeStampInLayout( 'RenderDebugInfo', $this->Render_debug_string );

        if(!empty($Render->Layout['variables']))
            foreach($Render->Layout['variables'] as $VariableName => $Value){
                $this->MakeStampInLayout($VariableName,$Value);
            }

    }

    public function RenderView($ViewName){

        if(empty($this->View))
            $this->View = new ArrayObject();

        $this->View->View = $this->getTplFile($ViewName);
    }

    public function MakeStampInLayout($VariableName, $Value)
    {   
        $render = Registry::get('Render');
        $render->Layout = str_replace('{$' . $VariableName . '}', $Value, $render->Layout);    
    }

    public function getLayout()
    {
        return $this->getTplFile('../../../layout');
    }

    public function getView($TemplateName)
    {
        //Устарело, больше не используется
        //$this->IsRequestForMainPage();
        return $this->getTplFile($TemplateName);
    }

    private function getTplFile($TemplateName)
    {

        if(!file_exists(Vehela::RootDir."/../static/templates/default/modules/{$this->Router->Module}/{$this->Router->Controller}/{$TemplateName}.tpl"))
            //echo "Файл представления {$TemplateName} не существует ";
            throw new PException("Файл представления {$TemplateName} не существует",500);

        ob_start();
        include (Vehela::RootDir."/../static/templates/default/modules/{$this->Router->Module}/{$this->Router->Controller}/{$TemplateName}.tpl");
        $tpl = ob_get_clean();
        return $tpl;
    }

    /*
    //Устарело, больше не используется
    private function IsRequestForMainPage()
    {
        if (empty($this->Module))
            $this->Module = 'main';

        if (empty($this->Controller))
            $this->Controller = 'welcome';

        if (empty($this->Action))
            $this->Action = 'hello';
    }

    */
}

?>

<?php

Class APIController extends PAPIController {

    public function userinfo(){

        if(!Registry::get('QuickPass'))
            if(isset($_GET['id'])){
                $project = Vehela::Model('User')->getById($_GET['id'],1);
                print(json_encode($project));
            }

    }

}


?>
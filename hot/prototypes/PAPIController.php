<?php

    require_once('PAPI.php');

    Class PAPIController extends PAPI{

        public function getTestFunctions(){

            $test = get_class_methods('Registry');
            var_dump($test);

        }


    }


?>
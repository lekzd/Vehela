<?php

    Class APIController extends PAPIController {

        public function debug(){
            if(isset($_GET['class']))
                var_dump(get_class_methods($_GET['class']));
        }

    }


?>
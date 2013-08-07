<?php

    Class DBQueue {

        public $queries = array();
        public $results = array();

        public function add($array){
            $this->queries[$array['table']][$array['function']]['query'][] = $array['query'];
        }

        public function get($Name){
            return $this->queries[$Name];
        }

        public function ExecuteRequests(){

            $DB = Registry::get('DB');

            foreach($this->queries as $model_key => $model){

                foreach($model as $functionName => $function){

                    if($functionName == 'getAll') {

                        foreach($function['query'] as $key => $query){
                            $Records = $DB->query($query);
                            $Records = $Records->fetchAll(PDO::FETCH_CLASS);
                            $this->PackResult($Records, $model_key,$functionName);
                        }

                    }

                    else

                        foreach($function['query'] as $key => $query){

                            $Record = $DB->query($query);
                            $Record = $Record->fetch(PDO::FETCH_ASSOC);
                            $this->PackResult($Record,$model_key,$functionName);
                        }

                }

            }

        }

        public function PackResult($array,$model,$functionName){

            $this->results[$model][$functionName][$array['id']] = $array;

        }

        public function ClearQueries(){
            unset($this->queries);
        }

    }


?>
<?php

    class User extends PModel
    {

        public $id;
        public $login;
        public $email;
        public $pass_salt;
        public $pass_hash;
        protected $tableName = 'user';

        public function getById($id,$force = null){

            $id = intval($id);
            if($force == null){

                if(Registry::get('QuickPass')) {
                    Registry::get('DBQueue')->add(array(
                        'table'=>$this->tableName,
                        'function'=>'getById',
                        'query'=>"SELECT * FROM {$this->tableName} where id = $id"
                    ));
                    return 1;
                }
                else {
                    $DBQueue = Registry::get('DBQueue');
                    if(empty($DBQueue->results[$this->tableName]['getById'][$id]))
                        return null;
                    else{
                        $modelName = get_class($this);
                        $record = $this->FillRecord(new $modelName(),$DBQueue->results[$this->tableName]['getById'][$id]);
                        return $record;
                    }

                }

            }

            else
            {

                $Record = $this->_dbObj->query("SELECT id, login, email, pass_salt, pass_hash FROM {$this->tableName} where id = $id");
                $Record = $Record->fetch(PDO::FETCH_ASSOC);

                $modelName = get_class($this);
                $Record = $this->FillRecord(new $modelName(),$Record);
                return $Record;


            }


        }

    }

?>


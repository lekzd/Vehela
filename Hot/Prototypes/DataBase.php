<?php

class DataBase
{

    public $host;
    public $user;
    public $password;
    public $db;
    private $db_resource;
    private $settings;

    public function __construct($settings)
    {
        foreach ($settings as $key => $parameter) {
            $this->$key = $parameter;
        }

        $this->Connect();
        $this->SelectDB($this->db);
    }

    public function Connect()
    {
        $this->db_resource = new mysqli($this->host, $this->user, $this->password);
        if ($this->db_resource->connect_errno == 0) {
            $this->db_resource->set_charset('utf8');
        } else {
            die($this->db_resource->connect_error);
        }
    }

    public function SelectDB($dbname)
    {
        $this->db_resource->select_db($dbname);
        if ($this->db_resource->errno != 0) {
            die($this->db_resource->error);
        }
    }

    public function query($query)
    {
        $result = $this->db_resource->query($query);
        if ($this->db_resource->errno == 0) {
            return $result;
        } else {
            # die($this->db_resource->error);
            return false;
        }
    }

}

?>
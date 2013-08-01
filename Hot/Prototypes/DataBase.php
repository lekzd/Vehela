<?php

class DataBase
{

    public $dsn;
    public $user;
    public $password;
    private $db_obj;

    public function __construct($settings)
    {
        foreach ($settings as $key => $parameter) {
            $this->$key = $parameter;
        }
        $this->Connect();
    }

    public function Connect()
    {
        try {
            $this->db_obj = new PDO($this->dsn, $this->user, $this->password);
            $this->exec('SET NAMES `utf8`;');
        } catch (PDOException $e) {
            die('Не удалось установить соединение с базой данных: ' . $e->getMessage());
        }
    }

    public function SelectDB($name)
    {
        $this->query("USE `{$name}`;");
    }

    public function getConnection()
    {
        return $this->db_obj;
    }

    public function query($query)
    {
        $result = $this->db_obj->query($query);
        if ($this->db_obj->errorCode() == 0000) {
            return $result;
        } else {
            die($this->db_obj->errorInfo()[2]);
            return false;
        }
    }

    public function exec($query)
    {
        $result = $this->db_obj->exec($query);
        if ($this->db_obj->errorCode() == 0000) {
            return $result;
        } else {
            die($this->db_obj->errorInfo()[2]);
            return false;
        }
    }

}

?>
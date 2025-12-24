<?php

class Database{
    public $host;
    public $dbname;
    public $username;
    public $password;
    public $port;

    public function __construct($host, $db, $user, $pass, $port = 3306)
    {
        $this->host = $host;
        $this->dbname = $db;
        $this->username = $user;
        $this->password = $pass;
        $this->port = $port;
    }


    public function getConnection()
    {
        return mysqli_connect($this->host, $this->username, $this->password,$this->dbname, $this->port);
    }
}

// $db = new Database("localhost", "gestion_event", "root", "", 3307);
// $conn = $db->getConnection();
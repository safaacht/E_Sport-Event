<?php
class Database{
    private $host="localhost";
    private $dbname="gestion_event";
    private $username="root";
    private $password="";
    private $port=3307;

    public $conn;

    public function __construct()
    {
       $this->conn= mysqli_connect($this->host, $this->username, $this->password,$this->dbname, $this->port);
    }


    public function getConnection()
    {
        return $this->conn;
    }
}

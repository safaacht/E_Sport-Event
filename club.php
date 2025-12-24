<?php
require "./database.php";

class Club {
    public string  $name, $ville;
    protected string $format;
    public $db;

    public function __construct()
    {
        $this->db = new Database("localhost", "gestion_event", "root", "", 3307);
    }

    public function getAll()
    {
        $conn = $this->db->getConnection();
        $result = mysqli_query($conn, "SELECT * FROM clubs");
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function create()
    {
        $conn = $this->db->getConnection();
        mysqli_query($conn, "INSERT INTO clubs(name, ville) VALUES('$this->name', '$this->ville')");
    }

    public function delete()
    {
        $conn = $this->db->getConnection();
        mysqli_query($conn, "DELETE FROM clubs WHERE $this->id");
    }
}
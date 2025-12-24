<?php
require "./database.php";

class Equipe {
    public int $id;
    public string $name;
    public string $jeu;
    public int $clubId;
    public $db;

    public function __construct()
    {
        $this->db = new Database("localhost", "gestion_event", "root", "", 3307);
    }

    public function getAll()
    {
        $conn = $this->db->getConnection();
        $result = mysqli_query($conn, "SELECT * FROM equipes");
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function create()
    {
        $conn = $this->db->getConnection();
        mysqli_query($conn, "INSERT INTO equipes(name,jeu, clubId) VALUES('$this->name','$this->jeu', '$this->clubId')");
    }

    public function delete()
    {
        $conn = $this->db->getConnection();
        mysqli_query($conn, "DELETE FROM equipes WHERE $this->id");
    }
}
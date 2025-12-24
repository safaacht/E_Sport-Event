<?php
require_once './database.php';

class Sponsor{
    public string $name;
    public int $ctrb_financiere;
    public int $tournoi_id;
    public $db;

     public function __construct()
    {
        $this->db = new Database("localhost", "gestion_event", "root", "", 3307);
    }

    public function getAll(){
        $conn=$this->db->getConnection();
        $sql=mysqli_query($conn,"SELECT * FROM sponsor");
        return mysqli_fetch_all($sql,MYSQLI_ASSOC);
    }

    public function create(){
        $conn=$this->db->getConnection();
        $sql="INSERT INTO sponsor VALUES(?,?,?)";
        $stmt=mysqli_prepare($conn,$sql);
        mysqli_stmt_bind_param($stmt,"sii",$this->name,$this->ctrb_financiere,$this->tournoi_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    public function delete(){
        $conn = $this->db->getConnection();

        $sql="DELETE ON sponsor WHERE $this->name";
        mysqli_query($conn,$sql);
    }
}
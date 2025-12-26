<?php
require_once "./database.php";
require_once 'club.php';
require_once 'participant.php';

class Equipe extends Participant {
    public int $id;
    private string $name;
    private string $jeu;
    private int $clubId;

    public function __construct($name=null,$jeu=null,$clubId=null,$id=null)
    {

        $this->name=$name;
        $this->jeu=$jeu;
        $this->clubId=$clubId;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getJeu(): string {
        return $this->jeu;
    }

    public function getClub()
    {
        return $this->clubId;
    }
   
    public function getAll($conn)
    {
        $result = mysqli_query($conn, "SELECT * FROM equipes");
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function create($conn)
    {
        mysqli_query($conn, "INSERT INTO equipes(name,jeu, clubId) VALUES('$this->name','$this->jeu', '$this->clubId')");
    }

    public function delete($conn)
    {
        mysqli_query($conn, "DELETE FROM equipes WHERE id=$this->id");
    }

    public function update($conn)
    {
        $stmt=mysqli_prepare($conn,"UPDATE team SET id=? , name=?, jeu=? clubId=? WHERE id=?");
        mysqli_stmt_bind_param($stmt,'issi', $this->id ,$this->name,$this->jeu ,$this->clubId, $this->id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
}
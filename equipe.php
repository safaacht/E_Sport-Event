<?php
require_once "./database.php";
require_once 'club.php';
require_once 'participant.php';

class Equipe extends Participant {
    private ?int $id;
    private ?string $name;
    private ?string $jeu;
    private ?int $club_id;

    public function __construct($name=null,$jeu=null,$club_id=null,$id=null)
    {
        $this->name=$name;
        $this->jeu=$jeu;
        $this->club_id=$club_id;
        $this->id=$id;
    }

    public function getName(): string {
        return $this->name;
    }

    public function setName($name):void{
        $this->name=$name;
    }

    public function setJeu($jeu):void{
        $this->jeu=$jeu;
    }

    public function getJeu(): string {
        return $this->jeu;
    }

    public function getClub()
    {
        return $this->club_id;
    }

    public function setClub($club_id):void{
        $this->club_id=$club_id;
    }
    
    
    public function setId(int $id): void { 
        $this->id = $id; 
    }

    public function getId($conn): ?int { 
        return $this->id; 
    }

    public function getAll($conn)
    {
        $result = mysqli_query($conn, "SELECT * FROM team");
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function create($conn)
    {
        mysqli_query($conn, "INSERT INTO team(name,jeu, club_id) VALUES('$this->name','$this->jeu', '$this->club_id')");
    }

    public function delete($conn)
    {
        mysqli_query($conn, "DELETE FROM team WHERE id=$this->id");
    }

    public function update($conn)
    {
        $stmt=mysqli_prepare($conn,"UPDATE team SET id=? , name=?, jeu=? club_id=? WHERE id=?");
        mysqli_stmt_bind_param($stmt,'ssi',$this->name,$this->jeu ,$this->club_id, $this->id);
        mysqli_stmt_execute($stmt);
        echo "Lignes modifiées : " . mysqli_stmt_affected_rows($stmt);
        mysqli_stmt_close($stmt);
    }
}
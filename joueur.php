<?php
require_once 'database.php';
class Joueur extends Participant{
    private int $id;
    private string $pseudo;
    private string $role;
    private float $salaire;
    public int $team_id;



    public function __construct($pseudo=null,$role=null,$salaire=null,$team_id=null,$id=null)
    {
        $this->pseudo=$pseudo;
        $this->role=$role;
        $this->salaire=$salaire;
        $this->team_id=$team_id;
        $this->id=$id;
    }

    public function getPseudo()
    {
        return $this->pseudo;

    }
     
    public function setPseudo($pseudo){

        $this->pseudo=$pseudo;
    }

    public function setRole($role):void
    {
        $this->role=$role;
    }

    public function getRole():string
    {
        return $this->role;
    }

    public function setSalaire($salaire):void
    {
        $this->salaire=$salaire;
    }

    public function getSalaire():float
    {
        return $this->salaire;
    }

    public function creat($conn)
    {
        $sql="INSERT INTO joueur VALUES(?,?,?,?)";
        $stmt=mysqli_prepare($conn,$sql);
        mysqli_stmt_bind_param($stmt,"ssfi",$pseudo,$role,$salaire,$team_id);
        mysqli_stmt_execute($stmt);
    }

    public function delete($conn)
    {
        mysqli_query($conn,"DELETE FROM joueur WHERE id=$this->id");
    }

    public function update($conn)
    {
        $stmt=mysqli_prepare($conn,"UPDATE joueur SET pseudo=?, role=?, salaire=?, team_id=? WHERE id=?");
        mysqli_stmt_bind_param($stmt,'ssiii', $this->pseudo,$this->role ,$this->salaire, $this->team_id,$this->id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
}

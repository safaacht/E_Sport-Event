<?php
require_once './database.php';

class Sponsor{
    private ?string $name;
    private ?float $contribution_finan;
    private ?int $tournoi_id;
    private ?int $id;

     public function __construct($name=null,$contribution_finan=null,$tournoi_id=null,$id=null)
    {
        $this->name=$name;
        $this->contribution_finan=$contribution_finan;
        $this->tournoi_id=$tournoi_id;
        $this->id=$id;
    }

    public function setId($id):void
    {
        $this->id=$id;
    }

    public function getId():?int
    {
        return $this->id;
    }
    public function setName($name):void
    {
        $this->name=$name;
    }

    public function getName():?string
    {
        return $this->name;
    }

    public function getContribution():?float
    {
        return $this->contribution_finan;
        
    }

    public function setContribution($contribution_finan):void
    {
        $this->contribution_finan=$contribution_finan;
    }

    public function setTournoiId( $tournoi_id):void
    {
        $this->tournoi_id=$tournoi_id;
    }
    public function getTournoiId():?int
    {
        return $this->tournoi_id;
    }
    public function getAll($conn){
        $sql=mysqli_query($conn,"SELECT * FROM sponsor");
        return mysqli_fetch_all($sql,MYSQLI_ASSOC);
    }

    public function create($conn){
        $sql="INSERT INTO sponsor (name, contribution_finan, tournoi_id) VALUES(?,?,?)";
        $stmt=mysqli_prepare($conn,$sql);
        mysqli_stmt_bind_param($stmt,"sdi",$this->name,$this->contribution_finan,$this->tournoi_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    public function delete($conn)
    {

        $sql="DELETE FROM sponsor WHERE id=$this->id";
        mysqli_query($conn,$sql);
    }
    public function update($conn)
    {
        $stmt=mysqli_prepare($conn,"UPDATE sponsor SET name=?, contribution_finan=? , tournoi_id=? WHERE id=?");
        mysqli_stmt_bind_param($stmt,'sdii', $this->name,$this->contribution_finan ,$this->tournoi_id, $this->id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

    }
}
<?php
require_once './database.php';

class Sponsor{
    private string $name;
    private float $ctrb_financiere;
    private int $tournoi_id;
    private int $id;

     public function __construct($name=null,$ctrb_financiere=null,$tournoi_id=null,$id=null)
    {
        $this->name=$name;
        $this->ctrb_financiere=$ctrb_financiere;
        $this->tournoi_id=$tournoi_id;
        $this->id=$id;
    }
    public function setName($name):void
    {
        $this->name=$name;
    }

    public function getName():string
    {
        return $this->name;
    }

    public function getContribution():float
    {
        return $this->ctrb_financiere;
        
    }

    public function setContribution($ctrb_financiere):void
    {
        $this->ctrb_financiere=$ctrb_financiere;
    }

    public function setTournoiId( $tournoi_id):void
    {
        $this->tournoi_id=$tournoi_id;
    }
    public function getTournoiId():int
    {
        return $this->tournoi_id;
    }
    public function getAll($conn){
        $sql=mysqli_query($conn,"SELECT * FROM sponsor");
        return mysqli_fetch_all($sql,MYSQLI_ASSOC);
    }

    public function create($conn){
        $sql="INSERT INTO sponsor VALUES(?,?,?)";
        $stmt=mysqli_prepare($conn,$sql);
        mysqli_stmt_bind_param($stmt,"sii",$this->name,$this->ctrb_financiere,$this->tournoi_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    public function delete($conn)
    {

        $sql="DELETE ON sponsor WHERE id=$this->id";
        mysqli_query($conn,$sql);
    }
    public function update($conn)
    {
        $stmt=mysqli_prepare($conn,"UPDATE sponsor SET name=?, contribution_finan=? tournoi_id=? WHERE id=?");
        mysqli_stmt_bind_param($stmt,'ssi', $this->name,$this->ctrb_financiere ,$this->tournoi_id, $this->id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

    }
}
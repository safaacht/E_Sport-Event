<?php
require_once "./database.php";

class Club {
    private  ?string $name;
    private ?string $ville;
    private ?int $id;

    public function __construct($name=null,$ville=null)
    {

        $this->name=$name;
        $this->ville=$ville;
    }

    public function getName(): ?string
    {
        return $this->name;      
    }

    public function setName(string $nom): void {
        $this->name = $nom;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville):void
    {
        $this->ville=$ville;
    }

    public function getId(): ?int 
    {
         return $this->id; 
    }

    public function setId(int $id):void{

        $this->id=$id;
    }

    public function getAll($conn)
    {
        $result = mysqli_query($conn, "SELECT * FROM clubs");
        $clubs=mysqli_fetch_all($result,MYSQLI_ASSOC);

        // Get total number of clubs
        $countResult = mysqli_query($conn, "SELECT COUNT(*) AS total FROM clubs");
        $countRow = mysqli_fetch_assoc($countResult);
        $total = $countRow['total'];
     
        return [
        'total_clubs' => $total,
        'clubs' => $clubs
        ];
    }

    public function create($conn)
    {
        mysqli_query($conn, "INSERT INTO clubs(name, ville) VALUES('$this->name', '$this->ville')");
    }

    public function delete($conn)
    {
        mysqli_query($conn, "DELETE FROM clubs WHERE id=$this->id");
    }

    public function update($conn){
        $stmt=mysqli_prepare($conn,"UPDATE clubs SET name=? ,ville=? WHERE id=?");
        mysqli_stmt_bind_param($stmt,'ssi',$this->name,$this->ville,$this->id);
        mysqli_stmt_execute($stmt);
        echo "Lignes modifiées : " . mysqli_stmt_affected_rows($stmt);
        mysqli_stmt_close($stmt);


    }

    public function creeDemande($conn,$tournoi)
    {
        $sql="SELECT id,name
        FROM team 
        WHERE club_id=$this->id ";

        $rslt=mysqli_query($conn,$sql);
        $clubTeams=mysqli_fetch_all($rslt,MYSQLI_ASSOC);

        var_dump($clubTeams);   
    }
}
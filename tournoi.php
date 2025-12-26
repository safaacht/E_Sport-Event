<?php
require_once 'event.php';
require_once 'database.php';

class Tournament extends Event {
    private string $format;

    public function __construct($titre=null,$cashprize=null,$format=null,$created_at=null,$id=null)
    {
        $this->titre=$titre;
        $this->cashprize=$cashprize;
        $this->format=$format;
        $this->created_at=$created_at;
        $this->id=$id;
    }

    public function setFormat(string $format):void
    {
        $this->format=$format;
    }
    public function getFormat():string
    {
        return $this->format;
    }
    public function getMoreData(): array
    {
        return[
        'format' => $this->format
        ];
    }
    public function getAllEvents($conn) {

        $sql = "SELECT * FROM events";
        $result = mysqli_query($conn, $sql);

        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function affichage(): array
    {
        return array_merge($this->getMoreData(), parent::affichage());
    }

    public function create($conn)
    {
        $sql="INSERT INTO team VALUES(?,?,?)";
        $stmt=mysqli_prepare($conn,$sql);
        mysqli_stmt_bind_param($stmt,"sis",$this->titre,$this->cashprize,$this->format);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    public function delete($conn)
    {
        mysqli_query($conn,"DELETE FROM tournoi WHERE id=$this->id");
    }

    public function update($conn)
    {
        $stmt=mysqli_prepare($conn,"UPDATE tournoi SET titre=?, cashprize=? , format=? WHERE id=?");
        mysqli_stmt_bind_param($stmt,'sii', $this->titre,$this->cashprize ,$this->format, $this->id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

    }
}

<?php
require_once './database.php';

abstract class Event{
    protected ?int $id;
    protected ?string $titre;
    protected ?int $cashprize;
    protected ?string $tounoi_date;

    abstract public function getAllEvents($conn);

    public function setId($id):void{
        $this->id=$id;
    }

    public function getId($conn):?int
    {
        return $this->id;
    }

    public function setTitre($titre):void{
        $this->titre=$titre;
    }
    
    public function getTitre($conn):?string
    {
        return $this->titre;
    }

    public function setCashprize($cashprize):void{
        $this->cashprize=$cashprize;
    }
    
    public function getCashprize($conn):?int
    {
        return $this->cashprize;
    }

    public function setTournoiDate($tounoi_date):void{
        $this->tounoi_date=$tounoi_date;
    }

    public function getTournoiDate($conn):?string
    {
        return $this->tounoi_date;
    }

    public function affichage(): array 
    {
        return [
            'id' => $this->id,
            'titre' => $this->titre,
            'cashprize' => $this->cashprize,
            'tounoi_date' => $this->tounoi_date
        ];
    }
}

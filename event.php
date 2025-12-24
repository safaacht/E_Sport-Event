<?php
require_once './database.php';

abstract class Event{
    protected int $id;
    protected string $titre;
    protected int $cashprize;
    protected string $created_at;

    public $db;

    public function __construct()
    {
        $conn=$this->db->getConnection();
        
    }

    abstract public function getAllEvents();

        public function affichage(): array 
        {
        return [
            'id' => $this->id,
            'titre' => $this->titre,
            'cashprize' => $this->cashprize,
            'created_at' => $this->created_at
        ];
    }
}

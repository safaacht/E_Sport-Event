<?php
require_once 'database.php';
require_once 'tournoi.php';
require_once 'equipe.php';

class Matches implements Calculable {
public function statistic(){
    
}

    private int $scoreA;
    private int $scoreB;
    private Equipe $equipeA;
    private Equipe $equipeB;
    private Tournament $tournoi;
    private Equipe $gagnant;
    public $db;
    
    public function __construct(
        int $scoreA,
        int $scoreB,
        Equipe $equipeA,
        Equipe $equipeB,
        Tournament $tournoi
    ) {
        $this->db = new Database("localhost", "gestion_event", "root", "", 3307);

        $this->scoreA = $scoreA;
        $this->scoreB = $scoreB;
        $this->equipeA = $equipeA;
        $this->equipeB = $equipeB;
        $this->tournoi = $tournoi;
        $this->gagnant = ($scoreA > $scoreB) ? $equipeA : $equipeB;
    }

    public function getGagnant(): Equipe {
        return $this->gagnant;
    }
    
}

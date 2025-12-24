<?php
require_once 'event.php';

class Tournament extends Event {
    private string $format;

    protected function getMoreData(): array
    {
        return[
        'format' => $this->format
        ];
    }
    public function getAllEvents() {
        $conn = $this->db->getConnection();
        $sql = "SELECT * FROM events";
        $result = mysqli_query($conn, $sql);

        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    public function affichage(): array
    {
        return array_merge($this->getMoreData(), parent::affichage());
    }
}

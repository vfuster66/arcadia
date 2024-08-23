<?php
class Horaires {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllHoraires() {
        $query = "SELECT * FROM horaires ORDER BY 
            CASE
                WHEN jour_semaine = 'Lundi' THEN 1
                WHEN jour_semaine = 'Mardi' THEN 2
                WHEN jour_semaine = 'Mercredi' THEN 3
                WHEN jour_semaine = 'Jeudi' THEN 4
                WHEN jour_semaine = 'Vendredi' THEN 5
                WHEN jour_semaine = 'Samedi' THEN 6
                WHEN jour_semaine = 'Dimanche' THEN 7
            END ASC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}
?>

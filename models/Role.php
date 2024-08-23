<?php

class Role {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getRoleById($role_id) {
        $query = "SELECT * FROM role WHERE role_id = :role_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':role_id', $role_id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>

<?php

class User {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function findUserByEmail($email) {
        error_log("Recherche de l'utilisateur par email: " . $email); // Log email recherché

        $query = "SELECT u.*, r.label AS role 
                  FROM utilisateur u 
                  JOIN role r ON u.role_id = r.role_id 
                  WHERE u.email = :email LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user) {
            error_log("Utilisateur trouvé: " . print_r($user, true)); // Log utilisateur trouvé
        } else {
            error_log("Aucun utilisateur trouvé pour cet email."); // Log si aucun utilisateur n'est trouvé
        }

        return $user;
    }

    public function verifyPassword($inputPassword, $storedHash) {
        $result = password_verify($inputPassword, $storedHash);
        error_log("Vérification du mot de passe: " . ($result ? "Succès" : "Échec")); // Log résultat de la vérification du mot de passe
        return $result;
    }
}
?>

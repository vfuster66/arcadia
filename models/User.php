<?php

class User {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function findUserByEmail($email) {
        $query = "SELECT u.*, r.label AS role 
                  FROM utilisateur u 
                  JOIN role r ON u.role_id = r.role_id 
                  WHERE u.email = :email LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: false;
    }

    public function verifyPassword($inputPassword, $storedHash) {
        return password_verify($inputPassword, $storedHash);
    }

    public function updateUser($id, $email, $password, $roleLabel, $nom, $prenom) {
        // Obtenir l'ID du rôle à partir du label
        $roleId = $this->getRoleIdByLabel($roleLabel);
    
        // Si un mot de passe est fourni, on le hache, sinon on garde l'ancien mot de passe
        $hashedPassword = $password ? password_hash($password, PASSWORD_DEFAULT) : $this->getUserPasswordById($id);
    
        $query = "UPDATE utilisateur SET email = :email, password = :password, role_id = :role_id, nom = :nom, prenom = :prenom WHERE id = :id";
        $stmt = $this->db->prepare($query);
    
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':role_id', $roleId, PDO::PARAM_INT);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    
        return $stmt->execute();
    }

    public function createUser($email, $password, $roleLabel, $nom, $prenom) {
        // Obtenir l'ID du rôle à partir du label
        $roleId = $this->getRoleIdByLabel($roleLabel);
    
        $query = "INSERT INTO utilisateur (email, password, role_id, nom, prenom) 
                  VALUES (:email, :password, :role_id, :nom, :prenom)";
        $stmt = $this->db->prepare($query);
        
        // Hacher le mot de passe
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':role_id', $roleId, PDO::PARAM_INT);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
    
        return $stmt->execute();
    }

    public function deleteUser($email)
    {
        // Vérifier si l'utilisateur est un administrateur
        $query = "SELECT role_id FROM utilisateur WHERE email = :email";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($user && $user['role_id'] == 1) {
            // Empêcher la suppression d'un administrateur
            return false;
        }
    
        // Si l'utilisateur n'est pas administrateur, autoriser la suppression
        $query = "DELETE FROM utilisateur WHERE email = :email";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([':email' => $email]);
    }    

    public function getRoleIdByLabel($roleLabel) {
        $query = "SELECT role_id FROM role WHERE label = :label LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':label', $roleLabel);
        $stmt->execute();
        $role = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $role ? $role['role_id'] : null;
    }

    public function getUserPasswordById($id) {
        $query = "SELECT password FROM utilisateur WHERE id = :id LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $user ? $user['password'] : null;
    }
}


?>

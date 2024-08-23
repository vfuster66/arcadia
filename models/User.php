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
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function verifyPassword($inputPassword, $storedHash) {
        return password_verify($inputPassword, $storedHash);
    }

    public function updateUser($userId, $username, $email, $password, $roleLabel, $nom, $prenom) {
        // Obtenir l'ID du rôle à partir du label
        $roleId = $this->getRoleIdByLabel($roleLabel);
    
        // Si un mot de passe est fourni, on le hache, sinon on garde l'ancien mot de passe
        $hashedPassword = $password ? password_hash($password, PASSWORD_DEFAULT) : $this->getUserPasswordById($userId);
    
        $query = "UPDATE utilisateur SET username = :username, email = :email, password = :password, role_id = :role_id, nom = :nom, prenom = :prenom WHERE user_id = :user_id";
        $stmt = $this->db->prepare($query);
    
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':role_id', $roleId, PDO::PARAM_INT); // Lier le rôle en tant qu'entier
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
    
        return $stmt->execute();
    }    

    public function createUser($username, $email, $password, $roleLabel, $nom, $prenom) {
        // Obtenir l'ID du rôle à partir du label
        $roleId = $this->getRoleIdByLabel($roleLabel);
    
        $query = "INSERT INTO utilisateur (username, email, password, role_id, nom, prenom) 
                VALUES (:username, :email, :password, :role_id, :nom, :prenom)";
        $stmt = $this->db->prepare($query);
        
        // Hacher le mot de passe
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->bindParam(':role_id', $roleId, PDO::PARAM_INT); // Lier le rôle en tant qu'entier
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
    
        return $stmt->execute();
    }

    public function deleteUser($userId) {
        // Vérifier si l'utilisateur est un administrateur
        $query = "SELECT r.label AS role 
                FROM utilisateur u 
                JOIN role r ON u.role_id = r.role_id 
                WHERE u.user_id = :user_id LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && $user['role'] === 'Administrateur') {
            // Empêcher la suppression de l'administrateur
            return false;
        }

        // Supprimer l'utilisateur si ce n'est pas un administrateur
        $query = "DELETE FROM utilisateur WHERE user_id = :user_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        return $stmt->execute();
    } 

    public function getAllUsers() {
        $query = "SELECT u.*, r.label AS role 
                FROM utilisateur u 
                JOIN role r ON u.role_id = r.role_id";
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRoleIdByLabel($roleLabel) {
        $query = "SELECT role_id FROM role WHERE label = :label LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':label', $roleLabel);
        $stmt->execute();
        $role = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $role ? $role['role_id'] : null;
    }

    public function getUserPasswordById($userId) {
        $query = "SELECT password FROM utilisateur WHERE user_id = :user_id LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
        return $user ? $user['password'] : null;
    }
    
}

?>
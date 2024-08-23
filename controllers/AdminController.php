<?php

require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../services/MailService.php';

class AdminController {
    private $userModel;
    private $mailService;

    public function __construct($pdo) {
        $this->userModel = new User($pdo);
        $this->mailService = new MailService();
    }

    // Méthode pour créer un utilisateur
    public function createUser($username, $email, $password, $roleLabel, $nom, $prenom) {
        // Création de l'utilisateur
        $userId = $this->userModel->createUser($username, $email, $password, $roleLabel, $nom, $prenom);
        // Envoi de l'email de création de compte
        $this->mailService->sendAccountCreationEmail($email, $username);
        return $userId;
    }

    // Méthode pour mettre à jour un utilisateur
    public function updateUser($userId, $username, $email, $password, $roleLabel, $nom, $prenom) {
        // Mise à jour de l'utilisateur
        $this->userModel->updateUser($userId, $username, $email, $password, $roleLabel, $nom, $prenom);
    }

    // Méthode pour supprimer un utilisateur
    public function deleteUser($id) {
        $this->userModel->deleteUser($id);
    }

    // Méthode pour obtenir tous les utilisateurs
    public function getAllUsers() {
        return $this->userModel->getAllUsers();
    }
}
?>

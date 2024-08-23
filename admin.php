<?php
require_once __DIR__ . '/config/db.php'; // Assurez-vous que votre connexion à la base de données est correcte
require_once __DIR__ . '/models/User.php';

try {
    // Créez une instance de la classe User
    $userModel = new User($pdo);

    // Définir les informations de l'administrateur
    $username = 'admin';
    $email = 'admin@arcadia.fr';
    $password = 'admin123'; // Choisissez un mot de passe sécurisé
    $role_id = 1; // Assurez-vous que l'ID du rôle Administrateur est 1 dans votre table "role"
    $nom = 'Admin';
    $prenom = 'Principal';

    // Créer l'utilisateur administrateur
    $userModel->createUser($username, $email, $password, $role_id, $nom, $prenom);

    echo "Administrateur créé avec succès.";

} catch (Exception $e) {
    echo "Erreur lors de la création de l'administrateur : " . $e->getMessage();
}

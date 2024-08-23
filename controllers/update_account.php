<?php
session_start();

// Activer l'affichage des erreurs
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../models/User.php';

// Vérifier si l'utilisateur est un administrateur connecté
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: /arcadia/views/connexion.php');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $userId = $_POST['user_id'];
    $name = $_POST['name'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Initialiser le modèle utilisateur
    $userModel = new User($pdo);

    // Mettre à jour l'utilisateur
    $userModel->updateUser($userId, $name, $email, $password, $role, $nom, $prenom);

    // Rediriger vers la page de gestion des comptes
    header('Location: /arcadia/views/admin_gestion_comptes.php');
    exit();
}
?>

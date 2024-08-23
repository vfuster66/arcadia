<?php
session_start();

// Activer l'affichage des erreurs
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Vérifier si l'utilisateur est un administrateur connecté
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: /arcadia/views/connexion.php');
    exit();
}

require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../models/User.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['account_id'];

    if (!empty($userId)) {
        $userModel = new User($pdo);
        $userModel->deleteUser($userId);
        header('Location: /arcadia/views/admin_gestion_comptes.php');
        exit();
    } else {
        // Gérer les erreurs ici (ID de compte vide)
        header('Location: /arcadia/views/admin_gestion_comptes.php?error=id_invalid');
        exit();
    }
} else {
    // Si la requête n'est pas POST, rediriger
    header('Location: /arcadia/views/admin_gestion_comptes.php');
    exit();
}

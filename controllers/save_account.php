<?php
session_start();

// Activer l'affichage des erreurs
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../services/MailService.php';

// Récupérer les données du formulaire
$username = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$role_label = $_POST['role'];  // Le label du rôle

// Créer l'utilisateur
$userModel = new User($pdo);
$userModel->createUser($username, $email, $password, $role_label, $nom, $prenom);

// Envoyer un email de création de compte
$mailService = new MailService();
$mailService->sendAccountCreationEmail($email, $username);

// Rediriger ou afficher un message de succès
header('Location: /arcadia/views/admin_gestion_comptes.php');
exit();
?>


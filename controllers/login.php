<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../controllers/AuthController.php';

session_start();

error_log("Début du traitement du formulaire de connexion"); // Log début du traitement du formulaire

$error = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    error_log("Formulaire soumis avec email: " . $email); // Log email soumis

    $authController = new AuthController($pdo);
    $error = $authController->login($email, $password);

    if ($error) {
        error_log("Erreur après tentative de connexion: " . $error); // Log erreur après la tentative de connexion
        $_SESSION['login_error'] = $error;
        header("Location: ../views/connexion.php");
        exit();
    }
}
?>

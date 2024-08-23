<?php
session_start();

require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email']; 
    $password = $_POST['password'];

    $userModel = new User($pdo);
    $user = $userModel->findUserByEmail($email);

    if ($user && $userModel->verifyPassword($password, $user['password'])) {
        // Stocker les informations de l'utilisateur dans la session
        $_SESSION['email'] = $user['email'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['user_id'] = $user['user_id'];

        // Rediriger l'utilisateur vers le tableau de bord en fonction de son rôle
        switch ($user['role']) {
            case 'admin':
                header("Location: /arcadia/views/admin_dashboard.php");
                break;
            case 'employe':
                header("Location: /arcadia/views/employe_dashboard.php");
                break;
            case 'veterinaire':
                header("Location: /arcadia/views/veterinaire_dashboard.php");
                break;
            default:
                $error = "Rôle utilisateur non reconnu.";
                break;
        }
        exit();
    } else {
        $error = "Email ou mot de passe incorrect.";
    }
}
?>

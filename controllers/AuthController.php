<?php

class AuthController {
    private $userModel;

    public function __construct($pdo) {
        $this->userModel = new User($pdo);
    }

    public function login($email, $password) {
        error_log("Tentative de connexion avec l'email: " . $email); // Log email utilisé pour la connexion

        $user = $this->userModel->findUserByEmail($email);

        if ($user && $this->userModel->verifyPassword($password, $user['password'])) {
            error_log("Connexion réussie pour l'utilisateur: " . $user['email']); // Log si la connexion réussit

            // Stocker les informations de l'utilisateur dans la session
            $_SESSION['email'] = $user['email'];
            $_SESSION['role_id'] = $user['role_id'];
            $_SESSION['role'] = $user['role'];

            // Redirection basée sur le role_id
            switch ($user['role_id']) {
                case 3:  // Administrateur
                    error_log("Redirection vers admin_dashboard.php"); // Log la redirection
                    header("Location: ../views/admin_dashboard.php");
                    break;
                case 2:  // Employé
                    error_log("Redirection vers employe_dashboard.php"); // Log la redirection
                    header("Location: ../views/employe_dashboard.php");
                    break;
                case 1:  // Vétérinaire
                    error_log("Redirection vers veterinaire_dashboard.php"); // Log la redirection
                    header("Location: ../views/veterinaire_dashboard.php");
                    break;
                default:
                    error_log("Role ID non reconnu, redirection vers connexion.php"); // Log si le role_id n'est pas reconnu
                    header("Location: ../views/connexion.php");
                    break;
            }
            exit();
        } else {
            error_log("Échec de la connexion: Email ou mot de passe incorrect."); // Log en cas d'échec de la connexion
            return "Email ou mot de passe incorrect.";
        }
    }
}
?>

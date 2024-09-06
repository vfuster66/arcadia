<?php

require_once __DIR__ . '/../models/User.php';

class AuthController {
    private $userModel;

    public function __construct($pdo) {
        $this->userModel = new User($pdo);
    }

    // Ajouter cette méthode pour les tests
    public function setUserModel($userModel) {
        $this->userModel = $userModel;
    }

    public function login($email, $password, $testMode = false) {
        //error_log("Tentative de connexion avec l'email: " . $email);

        $user = $this->userModel->findUserByEmail($email);

        if ($user && $this->userModel->verifyPassword($password, $user['password'])) {
            //error_log("Connexion réussie pour l'utilisateur: " . $user['email']);

            $_SESSION['email'] = $user['email'];
            $_SESSION['role_id'] = $user['role_id'];
            $_SESSION['role'] = $user['role'];

            if (!$testMode) {
                switch ($user['role_id']) {
                    case 1: // Administrateur
                        header("Location: ../views/admin_dashboard.php");
                        break;
                    case 2: // Employé
                        header("Location: ../views/employe_dashboard.php");
                        break;
                    case 3: // Vétérinaire
                        header("Location: ../views/veterinaire_dashboard.php");
                        break;
                    default:
                        header("Location: ../views/connexion.php");
                        break;
                }
                exit();
            } else {
                return ['role_id' => $user['role_id'], 'redirect_to' => $this->getRedirectPath($user['role_id'])];
            }
        } else {
            //error_log("Échec de la connexion: Email ou mot de passe incorrect.");
            return "Email ou mot de passe incorrect.";
        }
    }

    private function getRedirectPath($role_id) {
        switch ($role_id) {
            case 1:
                return 'admin_dashboard.php';
            case 2:
                return 'employe_dashboard.php';
            case 3:
                return 'veterinaire_dashboard.php';
            default:
                return 'connexion.php';
        }
    }
}

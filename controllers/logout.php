<?php
session_start();

// Vider toutes les variables de session
$_SESSION = array();

// Si vous souhaitez détruire complètement la session, y compris le cookie de session
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Détruire la session
session_destroy();

// Rediriger vers la page de connexion
header("Location: /arcadia/views/connexion.php");
exit();
?>

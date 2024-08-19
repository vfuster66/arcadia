<?php 
session_start();

// Simuler la connexion d'un utilisateur spécifique
// Vous pouvez changer le username et le rôle pour tester différents accès

$users = [
    'admin' => ['username' => 'admin', 'role' => 'admin'],
    'employe' => ['username' => 'employe', 'role' => 'employe'],
    'veterinaire' => ['username' => 'veterinaire', 'role' => 'veterinaire']
];

// Choisissez quel utilisateur simuler (admin, employe, veterinaire)
$selectedUser = $users['veterinaire'];  // Changez 'employe' par 'admin' ou 'veterinaire' pour tester d'autres rôles

// Définir la session pour l'utilisateur sélectionné
$_SESSION['username'] = $selectedUser['username'];
$_SESSION['role'] = $selectedUser['role'];

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?? 'Zoo Arcadia'; ?></title>
    <link rel="stylesheet" href="/arcadia/public/css/styles.css"> <!-- Style global -->
    <link rel="stylesheet" href="/arcadia/public/css/header.css"> <!-- Style spécifique au header -->
</head>
<body>
    <header>
        <div class="header-container">
            <div class="logo">
                <a href="accueil.php">
                    <img src="/arcadia/public/images/logo/Arcadia.svg" alt="Logo Arcadia">
                </a>
            </div>
            <nav class="main-nav">
                <ul>
                    <?php 
                    $currentPage = basename($_SERVER['PHP_SELF']);
                    $role = $_SESSION['role'];

                    if ($role == 'admin') : 
                    ?>
                        <li><a href="admin_dashboard.php">Accueil</a></li>
                        <li><a href="admin_gestion_comptes.php">Comptes</a></li>
                        <li><a href="admin_gestion_services.php">Services</a></li>
                        <li><a href="admin_gestion_habitats.php">Habitats</a></li>
                        <li><a href="admin_gestion_animaux.php">Animaux</a></li>
                        <li><a href="admin_consultation_compte_rendus.php">Compte-Rendus</a></li>
                        <li><a href="/arcadia/controllers/logout.php">Déconnexion</a></li>
                    <?php elseif ($role == 'employe') : ?>
                        <li><a href="employe_dashboard.php">Accueil</a></li>
                        <li><a href="admin_gestion_services.php">Services</a></li>
                        <li><a href="employe_gestion_avis.php">Avis</a></li>
                        <li><a href="employe_gestion_nourriture.php">Nourriture</a></li>
                        <li><a href="/arcadia/controllers/logout.php">Déconnexion</a></li>
                    <?php elseif ($role == 'veterinaire') : ?>
                        <li><a href="veterinaire_dashboard.php">Accueil</a></li>
                        <li><a href="veterinaire_gestion_compte_rendus.php">Santé</a></li>
                        <li><a href="veterinaire_consultation_nourriture.php">Nourriture</a></li>
                        <li><a href="veterinaire_gestion_habitats.php">Habitats</a></li>
                        <li><a href="/arcadia/controllers/logout.php">Déconnexion</a></li>
                    <?php else: ?>
                        <li><a href="accueil.php">Accueil</a></li>
                        <li><a href="services.php">Services</a></li>
                        <li><a href="habitats.php">Habitats</a></li>
                        <li><a href="connexion.php">Connexion</a></li>
                        <li><a href="contact.php">Contact</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>
</body>
</html>

<?php
session_start(); // Démarre la session ou reprend la session existante

// Définir le titre de la page si non défini
$title = $title ?? 'Zoo Arcadia';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($title); ?></title>
    <link rel="stylesheet" href="/arcadia/public/css/styles.css"> <!-- Style global -->
    <link rel="stylesheet" href="/arcadia/public/css/header.css"> <!-- Style spécifique au header -->
</head>
<body>
    <header>
        <div class="header-container">
            <div class="logo">
                <a href="/arcadia/views/accueil.php">
                    <img src="/arcadia/public/images/logo/Arcadia.svg" alt="Logo Arcadia">
                </a>
            </div>
            <nav class="main-nav">
                <ul>
                    <?php if (isset($_SESSION['email']) && isset($_SESSION['role'])): ?>
                        <?php
                        // Affichage du menu en fonction du rôle
                        switch ($_SESSION['role']) {
                            case 'admin':
                                echo '
                                    <li><a href="/arcadia/views/admin_dashboard.php">Tableau de Bord</a></li>
                                    <li><a href="/arcadia/views/admin_gestion_comptes.php">Comptes</a></li>
                                    <li><a href="/arcadia/views/admin_gestion_horaires.php">Horaires</a></li>
                                    <li><a href="/arcadia/views/admin_gestion_services.php">Services</a></li>
                                    <li><a href="/arcadia/views/admin_gestion_habitats.php">Habitats</a></li>
                                    <li><a href="/arcadia/views/admin_gestion_animaux.php">Animaux</a></li>
                                    <li><a href="/arcadia/views/admin_consultation_compte_rendus.php">Compte-Rendus</a></li>
                                    <li><a href="/arcadia/controllers/logout.php">Déconnexion</a></li>
                                ';
                                break;

                            case 'employe':
                                echo '
                                    <li><a href="/arcadia/views/employe_dashboard.php">Tableau de Bord</a></li>
                                    <li><a href="/arcadia/views/employe_gestion_avis.php">Avis</a></li>
                                    <li><a href="/arcadia/views/employe_gestion_nourriture.php">Alimentation</a></li>
                                    <li><a href="/arcadia/views/employe_gestion_services.php">Services</a></li>
                                    <li><a href="/arcadia/controllers/logout.php">Déconnexion</a></li>
                                ';
                                break;

                            case 'veterinaire':
                                echo '
                                    <li><a href="/arcadia/views/veterinaire_dashboard.php">Tableau de Bord</a></li>
                                    <li><a href="/arcadia/views/veterinaire_gestion_compte_rendus.php">Compte-Rendus</a></li>
                                    <li><a href="/arcadia/views/veterinaire_consultation_nourriture.php">Alimentation</a></li>
                                    <li><a href="/arcadia/views/veterinaire_gestion_habitats.php">Habitats</a></li>
                                    <li><a href="/arcadia/controllers/logout.php">Déconnexion</a></li>
                                ';
                                break;

                            default:
                                // Menu pour les visiteurs non connectés
                                echo '
                                    <li><a href="/arcadia/views/accueil.php">Accueil</a></li>
                                    <li><a href="/arcadia/views/services.php">Services</a></li>
                                    <li><a href="/arcadia/views/habitats.php">Habitats</a></li>
                                    <li><a href="/arcadia/views/connexion.php">Connexion</a></li>
                                    <li><a href="/arcadia/views/contact.php">Contact</a></li>
                                ';
                                break;
                        }
                        ?>
                    <?php else: ?>
                        <!-- Menu pour les visiteurs non connectés -->
                        <li><a href="/arcadia/views/accueil.php">Accueil</a></li>
                        <li><a href="/arcadia/views/services.php">Services</a></li>
                        <li><a href="/arcadia/views/habitats.php">Habitats</a></li>
                        <li><a href="/arcadia/views/connexion.php">Connexion</a></li>
                        <li><a href="/arcadia/views/contact.php">Contact</a></li>
                    <?php endif; ?>
                </ul>
            </nav>

            <!-- Menu hamburger pour les petits écrans -->
            <div class="hamburger-menu">
                <span></span>
                <span></span>
                <span></span>
            </div>

            <nav class="mobile-nav">
                <ul>
                    <?php if (isset($_SESSION['email']) && isset($_SESSION['role'])): ?>
                        <?php
                        switch ($_SESSION['role']) {
                            case 'admin':
                                echo '
                                    <li><a href="/arcadia/views/admin_dashboard.php">Tableau de Bord</a></li>
                                    <li><a href="/arcadia/views/admin_gestion_comptes.php">Comptes</a></li>
                                    <li><a href="/arcadia/views/admin_gestion_horaires.php">Horaires</a></li>
                                    <li><a href="/arcadia/views/admin_gestion_services.php">Services</a></li>
                                    <li><a href="/arcadia/views/admin_gestion_habitats.php">Habitats</a></li>
                                    <li><a href="/arcadia/views/admin_gestion_animaux.php">Animaux</a></li>
                                    <li><a href="/arcadia/views/admin_consultation_compte_rendus.php">Compte-Rendus</a></li>
                                    <li><a href="/arcadia/controllers/logout.php">Déconnexion</a></li>
                                ';
                                break;

                            case 'employe':
                                echo '
                                    <li><a href="/arcadia/views/employe_dashboard.php">Tableau de Bord</a></li>
                                    <li><a href="/arcadia/views/employe_gestion_avis.php">Avis</a></li>
                                    <li><a href="/arcadia/views/employe_gestion_nourriture.php">Alimentation</a></li>
                                    <li><a href="/arcadia/views/employe_gestion_services.php">Services</a></li>
                                    <li><a href="/arcadia/controllers/logout.php">Déconnexion</a></li>
                                ';
                                break;

                            case 'veterinaire':
                                echo '
                                    <li><a href="/arcadia/views/veterinaire_dashboard.php">Tableau de Bord</a></li>
                                    <li><a href="/arcadia/views/veterinaire_gestion_compte_rendus.php">Compte-Rendus</a></li>
                                    <li><a href="/arcadia/views/veterinaire_consultation_nourriture.php">Alimentation</a></li>
                                    <li><a href="/arcadia/views/veterinaire_gestion_habitats.php">Habitats</a></li>
                                    <li><a href="/arcadia/controllers/logout.php">Déconnexion</a></li>
                                ';
                                break;

                            default:
                                // Menu pour les visiteurs non connectés
                                echo '
                                    <li><a href="/arcadia/views/accueil.php">Accueil</a></li>
                                    <li><a href="/arcadia/views/services.php">Services</a></li>
                                    <li><a href="/arcadia/views/habitats.php">Habitats</a></li>
                                    <li><a href="/arcadia/views/connexion.php">Connexion</a></li>
                                    <li><a href="/arcadia/views/contact.php">Contact</a></li>
                                ';
                                break;
                        }
                        ?>
                    <?php else: ?>
                        <li><a href="/arcadia/views/accueil.php">Accueil</a></li>
                        <li><a href="/arcadia/views/services.php">Services</a></li>
                        <li><a href="/arcadia/views/habitats.php">Habitats</a></li>
                        <li><a href="/arcadia/views/connexion.php">Connexion</a></li>
                        <li><a href="/arcadia/views/contact.php">Contact</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </header>

    <script>
        document.querySelector('.hamburger-menu').addEventListener('click', function() {
            document.querySelector('.mobile-nav').classList.toggle('open');
        });
    </script>
</body>
</html>

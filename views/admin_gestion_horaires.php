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

$title = "Gestion des Horaires - admin";
include 'partials/header.php';
require_once __DIR__ . '/../config/db.php';  // Connexion à la base de données
?>

<link rel="stylesheet" href="/arcadia/public/css/admin-gestion-horaires.css"> <!-- Fichier CSS spécifique pour l'administration -->

<div class="main-container">
    <h1>Gestion des Horaires du Parc</h1>

    <!-- Section de gestion des horaires -->
    <div class="schedule-management">
        <form action="/arcadia/controllers/update_horaires.php" method="POST">
            <table>
                <thead>
                    <tr>
                        <th>Jour</th>
                        <th>Heure d'Ouverture</th>
                        <th>Heure de Fermeture</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Récupérer les horaires depuis la base de données
                    $query = "SELECT horaire_id, jour_semaine, heure_ouverture, heure_fermeture FROM horaires ORDER BY horaire_id";
                    $stmt = $pdo->query($query);
                    $horaires = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    // Afficher les horaires dans le tableau
                    foreach ($horaires as $horaire) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($horaire['jour_semaine']) . '</td>';
                        echo '<td><input type="time" name="heure_ouverture[' . $horaire['horaire_id'] . ']" value="' . htmlspecialchars($horaire['heure_ouverture']) . '" required></td>';
                        echo '<td><input type="time" name="heure_fermeture[' . $horaire['horaire_id'] . ']" value="' . htmlspecialchars($horaire['heure_fermeture']) . '" required></td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
            <button type="submit" class="btn-submit">Enregistrer les Horaires</button>
        </form>
    </div>
</div>

<?php include 'partials/footer.php'; ?>

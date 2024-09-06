<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$title = "Restauration et Snacks"; 
include 'partials/header.php'; 
require_once __DIR__ . '/../config/db.php'; // Connexion à la base de données

// Récupérer l'ID du service pour "Restauration et Snacks"
$query = "SELECT service_id FROM service WHERE nom = 'Restauration et Snacks'";
$stmt = $pdo->query($query);
$serviceId = $stmt->fetchColumn(); // Récupère la première colonne du résultat

// Récupérer les détails du service depuis la base de données
$queryDetails = "SELECT section_title, section_content, image_path FROM service_details WHERE service_id = :serviceId";
$stmtDetails = $pdo->prepare($queryDetails);
$stmtDetails->execute(['serviceId' => $serviceId]);
$serviceDetails = $stmtDetails->fetchAll(PDO::FETCH_ASSOC);

?>

<link rel="stylesheet" href="/arcadia/public/css/restauration.css"> <!-- Fichier CSS spécifique pour la page restauration -->

<div class="main-container">
    <?php foreach ($serviceDetails as $detail): ?>
        <!-- Ignorer les entrées sans image -->
        <?php if (!empty($detail['image_path'])): ?>
            <?php
            // Construire le chemin de l'image
            $imagePath = strpos($detail['image_path'], '/arcadia/') === 0 ? $detail['image_path'] : '/arcadia/' . ltrim($detail['image_path'], '/');
            ?>
            
            <?php if (!empty($detail['section_title']) && $detail['section_title'] === 'Restauration et Snacks'): ?>
                <!-- Section de Présentation Générale -->
                <h1><?= htmlspecialchars($detail['section_title']) ?></h1>
                <section id="restauration-presentation">
                    <p><?= nl2br(htmlspecialchars($detail['section_content'] ?? '')) ?></p>
                </section>

            <?php elseif (!empty($detail['section_title']) && $detail['section_title'] === 'Restaurant La Table d\'Arcadia'): ?>
                <!-- Section Restaurant -->
                <section id="restaurant">
                    <h2><?= htmlspecialchars($detail['section_title']) ?></h2>
                    <div class="restaurant-info">
                        <div class="gallery">
                            <img src="<?= htmlspecialchars($imagePath) ?>" alt="Restaurant La Table d'Arcadia">
                        </div>
                        <div class="menu-details">
                            <p><?= nl2br(htmlspecialchars($detail['section_content'] ?? '')) ?></p>
                        </div>
                    </div>
                </section>

            <?php elseif (!empty($detail['section_title']) && $detail['section_title'] === 'Snack Le Petit Creux'): ?>
                <!-- Section Snack -->
                <section id="snack">
                    <h2><?= htmlspecialchars($detail['section_title']) ?></h2>
                    <div class="snack-info">
                        <div class="gallery">
                            <img src="<?= htmlspecialchars($imagePath) ?>" alt="Snack Le Petit Creux">
                        </div>
                        <div class="menu-details">
                            <p><?= nl2br(htmlspecialchars($detail['section_content'] ?? '')) ?></p>
                        </div>
                    </div>
                </section>

            <?php elseif (!empty($detail['section_title']) && $detail['section_title'] === 'Point de Vente Sucré'): ?>
                <!-- Section Point de Vente Sucré -->
                <section id="point-de-vente-sucre">
                    <h2><?= htmlspecialchars($detail['section_title']) ?></h2>
                    <div class="sucre-info">
                        <div class="gallery">
                            <img src="<?= htmlspecialchars($imagePath) ?>" alt="Point de Vente Sucré">
                        </div>
                        <div class="menu-details">
                            <p><?= nl2br(htmlspecialchars($detail['section_content'] ?? '')) ?></p>
                        </div>
                    </div>
                </section>
            <?php endif; ?>
        <?php endif; ?>
    <?php endforeach; ?>
</div>

<?php 
include 'partials/footer.php'; 
?>

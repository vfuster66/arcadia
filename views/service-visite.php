<?php
$title = "Visite Guidée des Habitats"; 
include 'partials/header.php'; 
require_once __DIR__ . '/../config/db.php'; // Connexion à la base de données

// Récupérer l'ID du service pour "Visite Guidée Immersive"
$query = "SELECT service_id FROM service WHERE nom = 'Visite Guidée Immersive'";
$stmt = $pdo->query($query);
$serviceId = $stmt->fetchColumn(); // Récupère la première colonne du résultat

// Récupérer les détails du service depuis la base de données
$queryDetails = "SELECT section_title, section_content, image_path FROM service_details WHERE service_id = :serviceId";
$stmtDetails = $pdo->prepare($queryDetails);
$stmtDetails->execute(['serviceId' => $serviceId]);
$serviceDetails = $stmtDetails->fetchAll(PDO::FETCH_ASSOC);

$title = "Visite Guidée des Habitats"; // Titre spécifique pour cette page
?>

<link rel="stylesheet" href="/arcadia/public/css/visite.css"> <!-- Fichier CSS spécifique pour la page visite guidée -->

<div class="main-container">
    <!-- Titre Principal -->
    <h1>Visite Guidée des Habitats</h1>

    <!-- Section de Présentation -->
    <?php foreach ($serviceDetails as $detail): ?>
        <?php if ($detail['section_title'] === 'Visite Guidée Immersive'): ?>
            <section id="visite-presentation">
                <p><?= nl2br(htmlspecialchars($detail['section_content'])) ?></p>
            </section>
        <?php endif; ?>
    <?php endforeach; ?>

    <!-- Galerie de Photos des Habitats -->
    <section id="visite-photos">
        <div class="photo-gallery">
            <?php foreach ($serviceDetails as $detail): ?>
                <?php if ($detail['section_title'] === 'Galerie Photos' && $detail['image_path']): ?>
                    <?php
                    $imagePath = strpos($detail['image_path'], '/arcadia/') === 0 ? $detail['image_path'] : '/arcadia/' . ltrim($detail['image_path'], '/');
                    ?>
                    <img src="<?= htmlspecialchars($imagePath) ?>" alt="Galerie de photos">
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
        <!-- Bulles informatives -->
        <div class="bubble bubble-savane-lions">Le rugissement d'un lion peut être entendu à plus de 8 kilomètres à la ronde.</div>
        <div class="bubble bubble-savane-zebres">Les rayures des zèbres sont uniques à chaque individu, comme les empreintes digitales chez les humains.</div>
        <div class="bubble bubble-jungle-gorilles">Les gorilles sont principalement végétariens, mais ils consomment plus de 200 types de plantes différentes.</div>
        <div class="bubble bubble-jungle-ara">Les perroquets Ara sont capables d'imiter une grande variété de sons, y compris la voix humaine.</div>
        <div class="bubble bubble-marais-crocodiles">Les crocodiles peuvent vivre jusqu'à 100 ans.</div>
        <div class="bubble bubble-marais-salamandres">Les salamandres ont la capacité de régénérer leurs membres, leurs yeux, leur moelle épinière, leur cœur et même des parties de leur cerveau.</div>
    </section>

    <!-- Section Détails de la Visite -->
    <?php foreach ($serviceDetails as $detail): ?>
        <?php if ($detail['section_title'] === 'Détails de la Visite'): ?>
            <section id="visite-details">
                <h2>Détails de la Visite</h2>
                <p><?= nl2br(htmlspecialchars($detail['section_content'])) ?></p>
                <ul>
                    <li>11h00</li>
                    <li>13h00</li>
                    <li>15h00</li>
                    <li>17h00</li>
                </ul>
                <p><strong>Tarif : </strong>Gratuit</p>
                <p><strong>Réservation : </strong>Recommandée</p>
            </section>
        <?php endif; ?>
    <?php endforeach; ?>
</div>

<?php 
include 'partials/footer.php'; 
?>

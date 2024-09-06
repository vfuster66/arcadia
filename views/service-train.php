<?php 
include 'partials/header.php'; 
require_once __DIR__ . '/../config/db.php';  // Connexion à la base de données

// Récupérer l'ID du service pour "Visite Panoramique en Train"
$query = "SELECT service_id FROM service WHERE nom = 'Visite Panoramique en Train'";
$stmt = $pdo->query($query);
$serviceId = $stmt->fetchColumn(); // Récupère la première colonne du résultat

// Récupérer les détails du service depuis la base de données
$queryDetails = "SELECT section_title, section_content, image_path FROM service_details WHERE service_id = :serviceId";
$stmtDetails = $pdo->prepare($queryDetails);
$stmtDetails->execute(['serviceId' => $serviceId]);
$serviceDetails = $stmtDetails->fetchAll(PDO::FETCH_ASSOC);

$title = "Visite du Zoo en Petit Train"; // Titre spécifique pour cette page
?>

<link rel="stylesheet" href="/arcadia/public/css/train.css"> <!-- Fichier CSS spécifique pour la page du petit train -->

<div class="main-container">
    <?php 
    $hasGallerySection = false; // Pour vérifier si la section "Galerie Photos" a été affichée
    $images = []; // Stocker les chemins d'images pour la galerie

    foreach ($serviceDetails as $detail): ?>
        <?php if ($detail['section_title'] === 'Visite Panoramique en Train'): ?>
            <!-- Section Titre et Introduction -->
            <section id="train-title">
                <h1><?= htmlspecialchars($detail['section_title']) ?></h1>
                <p><?= nl2br(htmlspecialchars($detail['section_content'])) ?></p>
            </section>
        <?php elseif ($detail['section_title'] === 'Galerie Photos'): ?>
            <?php
            // Stocker l'image pour plus tard sans afficher le titre à chaque fois
            $imagePath = strpos($detail['image_path'], '/arcadia/') === 0 ? $detail['image_path'] : '/arcadia/' . ltrim($detail['image_path'], '/');
            $images[] = htmlspecialchars($imagePath);
            ?>
        <?php elseif ($detail['section_title'] === 'Détails du Tour en Train'): ?>
            <!-- Section Détails du Tour en Train -->
            <section id="train-details">
                <h2>Détails de la Visite en Train</h2>
                <p><?= nl2br(htmlspecialchars($detail['section_content'])) ?></p>

                <h3>Points d'Arrêt du Train</h3>
                <ul>
                    <li><strong>Arrêt 1 :</strong> La Jungle – Découvrez la végétation dense et les espèces qui y résident, comme les gorilles et les perroquets aras.</li>
                    <li><strong>Arrêt 2 :</strong> La Savane – Admirez les majestueux lions et les groupes de zèbres en train de paître dans cet environnement vaste et ouvert.</li>
                    <li><strong>Arrêt 3 :</strong> Le Marais – Observez les alligators et les salamandres dans leur habitat aquatique naturel.</li>
                </ul>

                <h3>Vues Panoramiques Exclusives</h3>
                <p>Le tour en train offre également des vues panoramiques que vous ne pourrez découvrir qu'à bord. Vous verrez des scènes à couper le souffle, où la faune et la flore se dévoilent sous leur meilleur jour, loin des sentiers pédestres traditionnels.</p>
            </section>
        <?php elseif ($detail['section_title'] === 'Horaires et Tarifs'): ?>
            <!-- Section Horaires et Tarifs -->
            <section id="train-schedule-pricing">
                <h2>Horaires et Tarifs</h2>
                <p><?= nl2br(htmlspecialchars($detail['section_content'])) ?></p>
            </section>
        <?php endif; ?>
    <?php endforeach; ?>

    <!-- Section Galerie Photos (affiché une seule fois) -->
    <?php if (!empty($images)): ?>
        <section id="train-gallery">
            <h2>Galerie Photos</h2>
            <div class="gallery">
                <?php foreach ($images as $image): ?>
                    <img src="<?= $image ?>" alt="Galerie de photos">
                <?php endforeach; ?>
            </div>
        </section>
    <?php endif; ?>
</div>

<?php 
include 'partials/footer.php'; 
?>

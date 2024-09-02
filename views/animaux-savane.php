<?php
require_once __DIR__ . '/../config/db.php';

// Remplacez '1' par l'ID de l'habitat que vous voulez filtrer
$habitatId = 1;

$query = "SELECT 
            a.animal_id,
            a.prenom,
            a.etat,
            a.details,
            a.species,
            a.nourriture,
            a.quantite,
            a.dernier_controle_veterinaire,
            i.image_path 
          FROM animal a
          LEFT JOIN image i ON a.image_id = i.image_id
          WHERE a.habitat_id = :habitatId";

$stmt = $pdo->prepare($query);
$stmt->execute(['habitatId' => $habitatId]);
$animaux = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="animal-cards">
    <?php foreach ($animaux as $animal): ?>
        <div class="animal-card">
            <div class="animal-card-inner">
                <div class="animal-card-front">
                    <!-- Ajout de la base URL si nécessaire -->
                    <img src="<?= htmlspecialchars('/arcadia/' . ltrim($animal['image_path'], '/')) ?>" alt="<?= htmlspecialchars($animal['prenom']) ?>">
                    <h3><?= htmlspecialchars($animal['prenom']) ?></h3>
                    <p><?= htmlspecialchars($animal['species']) ?></p>
                </div>
                <div class="animal-card-back">
                    <p><strong>État :</strong> <?= htmlspecialchars($animal['etat']) ?></p>
                    <p><strong>Nourriture :</strong> <?= htmlspecialchars($animal['nourriture']) ?> (<?= htmlspecialchars($animal['quantite']) ?>)</p>
                    <p><strong>Dernier contrôle vétérinaire :</strong> <?= htmlspecialchars($animal['dernier_controle_veterinaire']) ?></p>
                    <p><strong>Détails :</strong> <?= htmlspecialchars($animal['details']) ?></p>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>


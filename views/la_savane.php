<?php
$title = "La Savane";
include 'partials/header.php';
require_once __DIR__ . '/../config/db.php';  // Connexion à la base de données

// Récupérer les animaux pour l'habitat "La Savane"
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
          LEFT JOIN habitat h ON a.habitat_id = h.habitat_id
          WHERE h.nom = 'La Savane'";
$stmt = $pdo->query($query);
$animaux = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<link rel="stylesheet" href="/arcadia/public/css/la_savane.css"> <!-- Styles spécifiques à la page La Savane -->

<div class="main-container">
    <!-- Titre principal -->
    <h1>La Savane</h1>

    <!-- Description détaillée de l'habitat -->
    <section id="description">
        <p>La savane est un écosystème vaste et complexe, caractérisé par ses vastes étendues herbeuses, parsemées d'arbres et d'arbustes. Ce type de paysage est commun dans les régions tropicales et subtropicales, notamment en Afrique, où il abrite certaines des espèces les plus emblématiques de la planète.</p>
        <p>Dans la savane, la vie s'organise autour des cycles de la saison sèche et de la saison des pluies. Pendant la saison sèche, les herbes se fanent et l'eau devient rare, obligeant les animaux à se déplacer sur de grandes distances pour trouver de la nourriture et de l'eau. Lorsque la saison des pluies arrive, la savane se transforme en un océan de verdure, offrant une abondance de nourriture à ses habitants.</p>
        <p>Les animaux de la savane ont développé des adaptations fascinantes pour survivre dans cet environnement. Les herbivores, tels que les zèbres et les antilopes, vivent en grands troupeaux pour se protéger des prédateurs, tandis que les prédateurs comme les lions chassent en groupes pour augmenter leurs chances de succès.</p>
        <p>La savane joue un rôle crucial dans la biodiversité mondiale. Elle sert de refuge pour de nombreuses espèces et contribue à l'équilibre écologique global en régulant les cycles de carbone et d'eau.</p>
    </section>

    <!-- Galerie de photos de l'habitat -->
    <section id="photos">
        <h2>Découvrez La Savane en Images</h2>
        <div class="photo-gallery">
            <img src="/arcadia/public/images/habitats/savane11.jpg" alt="Paysage de la savane">
            <img src="/arcadia/public/images/habitats/savane8.jpg" alt="Animaux de la savane">
            <img src="/arcadia/public/images/habitats/savane10.jpg" alt="Coucher de soleil sur la savane">
            <img src="/arcadia/public/images/habitats/savane7.jpg" alt="Arbre emblématique de la savane">
            <img src="/arcadia/public/images/habitats/savane12.jpg" alt="Herd of zebras in the savanna">
        </div>
    </section>

    <!-- Section des animaux de l'habitat -->
    <section id="la_savane-animaux">
        <h2>Les Résidents de La Savane</h2>
        <div class="animal-cards">
            <?php foreach ($animaux as $animal): ?>
                <?php 
                    // Ajuster le chemin de l'image si nécessaire
                    $imagePath = htmlspecialchars($animal['image_path']);
                    if (strpos($imagePath, '') !== 0) {
                        $imagePath = '/arcadia/public/images/animaux/' . ltrim($imagePath, '/');
                    }
                ?>
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
    </section>
</div>

<?php
include 'partials/footer.php';
?>

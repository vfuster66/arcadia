<?php
$title = "Le Marais";
include 'partials/header.php';
require_once __DIR__ . '/../config/db.php';  // Connexion à la base de données

// Récupérer les animaux pour l'habitat "Le Marais"
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
          WHERE h.nom = 'Le Marais'";
$stmt = $pdo->query($query);
$animaux = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<link rel="stylesheet" href="/arcadia/public/css/le_marais.css"> <!-- Styles spécifiques à la page Le Marais -->

<div class="main-container">
    <!-- Titre principal -->
    <h1>Le Marais</h1>

    <!-- Description détaillée de l'habitat -->
    <section id="description">
        <p>Le marais est un écosystème aquatique unique, caractérisé par des zones humides, des étangs et des marécages. C'est un environnement riche en biodiversité où cohabitent une variété d'espèces animales et végétales, toutes parfaitement adaptées à ces conditions humides.</p>
        <p>Les marais jouent un rôle essentiel dans l'équilibre écologique, agissant comme des filtres naturels pour purifier l'eau et offrir un habitat sûr à de nombreuses espèces. En visitant notre section marais, vous pourrez découvrir des animaux fascinants tels que des crocodiles, des flamants roses, et bien d'autres encore.</p>
        <p>Le marais est souvent perçu comme un lieu mystérieux et enchanteur, où la nature révèle ses secrets à ceux qui prennent le temps d'observer.</p>
    </section>

    <!-- Galerie de photos de l'habitat -->
    <section id="photos">
        <h2>Découvrez Le Marais en Images</h2>
        <div class="photo-gallery">
            <img src="/arcadia/public/images/habitats/marais5.jpg" alt="Paysage du marais">
            <img src="/arcadia/public/images/habitats/marais4.jpg" alt="Vie sauvage dans le marais">
            <img src="/arcadia/public/images/habitats/marais6.jpg" alt="Plantes aquatiques">
        </div>
    </section>

    <!-- Section des animaux de l'habitat -->
    <section id="le_marais-animaux">
        <h2>Les Résidents du Marais</h2>
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

<?php
$title = "La Jungle";
include 'partials/header.php';
require_once __DIR__ . '/../config/db.php';  // Connexion à la base de données

// Récupérer les animaux pour l'habitat "La Jungle"
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
          WHERE h.nom = 'La Jungle'";
$stmt = $pdo->query($query);
$animaux = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<link rel="stylesheet" href="/arcadia/public/css/la_jungle.css"> <!-- Styles spécifiques à la page La Jungle -->

<div class="main-container">
    <!-- Titre principal -->
    <h1>La Jungle</h1>

    <!-- Description détaillée de l'habitat -->
    <section id="description">
        <p>La jungle est un écosystème luxuriant et dense, caractérisé par une végétation abondante, des arbres gigantesques, et une biodiversité incroyablement riche. Cet environnement est souvent associé aux forêts tropicales humides, où les précipitations sont abondantes et où la vie prospère à tous les niveaux de la canopée.</p>
        <p>Les jungles sont des habitats critiques pour de nombreuses espèces de plantes, d'animaux et d'insectes, et jouent un rôle essentiel dans la régulation du climat mondial. La densité de la végétation et l'humidité élevée créent un environnement unique, où la lumière du soleil parvient difficilement au sol, laissant place à un monde de mystère et de découverte.</p>
        <p>Dans notre parc, la section jungle vous permet d'explorer cette biodiversité extraordinaire, avec des espèces qui sont parfaitement adaptées à ces conditions spécifiques.</p>
    </section>

    <!-- Galerie de photos de l'habitat -->
    <section id="photos">
        <h2>Découvrez La Jungle en Images</h2>
        <div class="photo-gallery">
            <img src="/arcadia/public/images/habitats/jungle5.jpg" alt="Paysage de la jungle">
            <img src="/arcadia/public/images/habitats/jungle6.jpg" alt="Vue de la canopée">
            <img src="/arcadia/public/images/habitats/jungle7.jpg" alt="Faune de la jungle">
            <!-- Ajoutez d'autres images si nécessaire -->
        </div>
    </section>

    <!-- Section des animaux de l'habitat -->
    <section id="la_jungle-animaux">
        <h2>Les Résidents de La Jungle</h2>
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

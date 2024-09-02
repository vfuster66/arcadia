<?php

function createHabitatPage($nomHabitat, $descriptionRapide, $descriptionDetaillee, $images, $animaux) {
    // Convertir le nom de l'habitat en nom de fichier (par exemple, "La Jungle" devient "la_jungle")
    $filenameBase = strtolower(str_replace(' ', '_', $nomHabitat));
    $phpFilename = $filenameBase . '.php';
    $cssFilename = $filenameBase . '.css';
    $filePath = __DIR__ . '/../views/' . $phpFilename;

    // Contenu du fichier PHP à créer
    $content = <<<PHP
<?php 
\$title = "$nomHabitat";
include 'partials/header.php'; 
?>
<link rel="stylesheet" href="/arcadia/public/css/{$cssFilename}"> <!-- Styles spécifiques à la page {$nomHabitat} -->

<div class="main-container">
    <!-- Titre principal -->
    <h1>$nomHabitat</h1>

    <!-- Description détaillée de l'habitat -->
    <section id="description">
        <p>$descriptionDetaillee</p>
    </section>

    <!-- Galerie de photos de l'habitat -->
    <section id="photos">
        <h2>Découvrez $nomHabitat en Images</h2>
        <div class="photo-gallery">
PHP;

    // Ajouter les images au contenu
    foreach ($images as $image) {
        // Vérifier si le chemin contient déjà "/arcadia/public/images/habitats/"
        $imagePath = strpos($image['image_path'], '/arcadia/public/images/habitats/') === 0 
            ? $image['image_path'] 
            : '/arcadia/public/images/habitats/' . $image['image_path'];
    
        $content .= <<<PHP
            <img src="{$imagePath}" alt="{$image['alt_text']}">
PHP;
    }

    $content .= <<<PHP
        </div>
    </section>

    <!-- Section des animaux de l'habitat -->
    <section id="{$filenameBase}-animaux">
        <h2>Les Résidents de $nomHabitat</h2>
        <div class="animal-cards">
PHP;

    // Ajouter les cartes d'animaux au contenu
    foreach ($animaux as $animal) {
        $animalPrenom = htmlspecialchars($animal['prenom']);
        $animalSpecies = htmlspecialchars($animal['species']);
        $animalEtat = htmlspecialchars($animal['etat']);
        $animalNourriture = htmlspecialchars($animal['nourriture']);
        $animalQuantite = htmlspecialchars($animal['quantite']);
        $animalControle = htmlspecialchars($animal['dernier_controle_veterinaire']);
        $animalDetails = htmlspecialchars($animal['details']);
        $animalImagePath = htmlspecialchars($animal['image_path']);
        
        $content .= <<<PHP
            <div class="animal-card">
                <div class="animal-card-inner">
                    <div class="animal-card-front">
                        <img src="{$animalImagePath}" alt="{$animalPrenom}">
                        <h3>{$animalPrenom}</h3>
                        <p>{$animalSpecies}</p>
                    </div>
                    <div class="animal-card-back">
                        <p><strong>État :</strong> {$animalEtat}</p>
                        <p><strong>Nourriture :</strong> {$animalNourriture} ({$animalQuantite})</p>
                        <p><strong>Dernier contrôle vétérinaire :</strong> {$animalControle}</p>
                        <p><strong>Détails :</strong> {$animalDetails}</p>
                    </div>
                </div>
            </div>
PHP;
    }

    $content .= <<<PHP
        </div>
    </section>
</div>

<?php 
include 'partials/footer.php'; 
?>
PHP;

    // Créer le fichier PHP pour l'habitat
    file_put_contents($filePath, $content);
}

?>

<?php 
$title = "La Savane"; 
include 'partials/header.php'; 
?>
<link rel="stylesheet" href="/arcadia/public/css/savane.css"> <!-- Fichier CSS spécifique pour la page Savane -->

<div class="main-container">
    <!-- Titre principal -->
    <h1>La Savane</h1>

    <!-- Description détaillée de la savane -->
    <section id="description-savane">
        <p>La savane est un écosystème vaste et complexe, caractérisé par ses vastes étendues herbeuses, parsemées d'arbres et d'arbustes. Ce type de paysage est commun dans les régions tropicales et subtropicales, notamment en Afrique, où il abrite certaines des espèces les plus emblématiques de la planète.</p>
        <p>Dans la savane, la vie s'organise autour des cycles de la saison sèche et de la saison des pluies. Pendant la saison sèche, les herbes se fanent et l'eau devient rare, obligeant les animaux à se déplacer sur de grandes distances pour trouver de la nourriture et de l'eau. Lorsque la saison des pluies arrive, la savane se transforme en un océan de verdure, offrant une abondance de nourriture à ses habitants.</p>
        <p>Les animaux de la savane ont développé des adaptations fascinantes pour survivre dans cet environnement. Les herbivores, tels que les zèbres et les antilopes, vivent en grands troupeaux pour se protéger des prédateurs, tandis que les prédateurs comme les lions chassent en groupes pour augmenter leurs chances de succès.</p>
        <p>La savane joue un rôle crucial dans la biodiversité mondiale. Elle sert de refuge pour de nombreuses espèces et contribue à l'équilibre écologique global en régulant les cycles de carbone et d'eau.</p>
    </section>

    <!-- Galerie de photos de la savane -->
    <section id="photos-savane">
        <h2>Découvrez la Savane en Images</h2>
        <div class="photo-gallery">
            <img src="/arcadia/public/images/habitats/savane11.jpg" alt="Paysage de la savane">
            <img src="/arcadia/public/images/habitats/savane8.jpg" alt="Animaux de la savane">
            <img src="/arcadia/public/images/habitats/savane10.jpg" alt="Coucher de soleil sur la savane">
            <img src="/arcadia/public/images/habitats/savane7.jpg" alt="Arbre emblématique de la savane">
            <img src="/arcadia/public/images/habitats/savane12.jpg" alt="Herd of zebras in the savanna">
        </div>
    </section>

    <!-- Section des animaux de la savane -->
    <section id="savane-animaux">
        <h2>Les Résidents de la Savane</h2>
        <?php include 'animaux-savane.php'; ?>
    </section>
</div>

<?php 
include 'partials/footer.php'; 
?>

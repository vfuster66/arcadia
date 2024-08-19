<?php 
$title = "Le Marais"; 
include 'partials/header.php'; 
?>
<link rel="stylesheet" href="/arcadia/public/css/marais.css"> <!-- Styles spécifiques à la page Marais -->

<div class="main-container">
    <!-- Titre principal -->
    <h1>Le Marais</h1>

    <!-- Description détaillée du marais -->
    <section id="description-marais">
        <p>Le marais est un écosystème aquatique unique, caractérisé par des zones humides, des étangs et des marécages. C'est un environnement riche en biodiversité où cohabitent une variété d'espèces animales et végétales, toutes parfaitement adaptées à ces conditions humides.</p>
        <p>Les marais jouent un rôle essentiel dans l'équilibre écologique, agissant comme des filtres naturels pour purifier l'eau et offrir un habitat sûr à de nombreuses espèces. En visitant notre section marais, vous pourrez découvrir des animaux fascinants tels que des crocodiles, des flamants roses, et bien d'autres encore.</p>
        <p>Le marais est souvent perçu comme un lieu mystérieux et enchanteur, où la nature révèle ses secrets à ceux qui prennent le temps d'observer.</p>
    </section>

    <!-- Galerie de photos du marais -->
    <section id="photos-marais">
        <h2>Explorez le Marais en Images</h2>
        <div class="photo-gallery">
            <img src="/arcadia/public/images/habitats/marais5.jpg" alt="Paysage du marais">
            <img src="/arcadia/public/images/habitats/marais4.jpg" alt="Vie sauvage dans le marais">
            <img src="/arcadia/public/images/habitats/marais6.jpg" alt="Plantes aquatiques">
            <!-- Ajoutez d'autres images si nécessaire -->
        </div>
    </section>

    <!-- Section des animaux du marais -->
    <section id="marais-animaux">
        <h2>Les Habitants du Marais</h2>
        <?php include 'animaux-marais.php'; ?>
    </section>
</div>

<?php 
include 'partials/footer.php'; 
?>

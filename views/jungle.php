<?php 
$title = "La Jungle"; 
include 'partials/header.php'; 
?>
<link rel="stylesheet" href="/arcadia/public/css/jungle.css"> <!-- Styles spécifiques à la page Jungle -->

<div class="main-container">
    <!-- Titre principal -->
    <h1>La Jungle</h1>

    <!-- Description détaillée de la jungle -->
    <section id="description-jungle">
        <p>La jungle est un écosystème luxuriant et dense, caractérisé par une végétation abondante, des arbres gigantesques, et une biodiversité incroyablement riche. Cet environnement est souvent associé aux forêts tropicales humides, où les précipitations sont abondantes et où la vie prospère à tous les niveaux de la canopée.</p>
        <p>Les jungles sont des habitats critiques pour de nombreuses espèces de plantes, d'animaux et d'insectes, et jouent un rôle essentiel dans la régulation du climat mondial. La densité de la végétation et l'humidité élevée créent un environnement unique, où la lumière du soleil parvient difficilement au sol, laissant place à un monde de mystère et de découverte.</p>
        <p>Dans notre parc, la section jungle vous permet d'explorer cette biodiversité extraordinaire, avec des espèces qui sont parfaitement adaptées à ces conditions spécifiques.</p>
    </section>

    <!-- Galerie de photos de la jungle -->
    <section id="photos-jungle">
        <h2>Découvrez la Jungle en Images</h2>
        <div class="photo-gallery">
            <img src="/arcadia/public/images/habitats/jungle5.jpg" alt="Paysage de la jungle">
            <img src="/arcadia/public/images/habitats/jungle6.jpg" alt="Vue de la canopée">
            <img src="/arcadia/public/images/habitats/jungle7.jpg" alt="Faune de la jungle">
            <!-- Ajoutez d'autres images si nécessaire -->
        </div>
    </section>

    <!-- Section des animaux de la jungle -->
    <section id="jungle-animaux">
        <h2>Les Résidents de la Jungle</h2>
        <?php include 'animaux-jungle.php'; ?>
    </section>
</div>

<?php 
include 'partials/footer.php'; 
?>

<?php 
$title = "Nos Habitats"; 
include 'partials/header.php'; 
?>
<link rel="stylesheet" href="/arcadia/public/css/habitats.css"> <!-- Fichier CSS spécifique pour la page des habitats -->
<link rel="stylesheet" href="/arcadia/public/css/animaux.css"> <!-- Fichier CSS spécifique pour les animaux -->

<div class="main-container">
    <h1>Découvrez Nos Habitats</h1>

    <div class="habitats-grid">
        <!-- Habitat Savane -->
        <div class="habitat-card">
            <a href="savane.php">
                <img src="/arcadia/public/images/habitats/savane4.jpg" alt="Savane">
                <h2>La Savane</h2>
            </a>
            <p>Explorez les vastes plaines où les lions, éléphants, et girafes règnent en maîtres.</p>
        </div>

        <!-- Habitat Jungle -->
        <div class="habitat-card">
            <a href="jungle.php">
                <img src="/arcadia/public/images/habitats/jungle2.jpg" alt="Jungle">
                <h2>La Jungle</h2>
            </a>
            <p>Plongez dans l'épaisse végétation où résident tigres, singes et autres créatures exotiques.</p>
        </div>

        <!-- Habitat Marais -->
        <div class="habitat-card">
            <a href="marais.php">
                <img src="/arcadia/public/images/habitats/marais3.jpg" alt="Marais">
                <h2>Le Marais</h2>
            </a>
            <p>Découvrez les eaux mystérieuses où vivent crocodiles, hippopotames, et flamants roses.</p>
        </div>
    </div>
</div>

<?php 
include 'partials/footer.php'; 
?>

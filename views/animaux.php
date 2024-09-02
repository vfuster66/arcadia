<?php 
$title = "Nos Animaux"; 
include 'partials/header.php'; 
?>
<link rel="stylesheet" href="/arcadia/public/css/animaux.css"> <!-- Fichier CSS spécifique pour la page des animaux -->

<div class="main-container">

    <!-- Section La Savane -->
    <section id="savane">
        <h2>La Savane</h2>
        <?php include 'animaux-savane.php'; ?>
    </section>

    <!-- Section La Jungle -->
    <section id="jungle">
        <h2>La Jungle</h2>
        <?php include 'animaux-jungle.php'; ?>
    </section>

    <!-- Section Le Marais -->
    <section id="marais">
        <h2>Le Marais</h2>
        <?php include 'animaux-marais.php'; ?>
    </section>

</div>

<?php 
include 'partials/footer.php'; 
?>

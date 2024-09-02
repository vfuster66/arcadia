<?php 
$title = "Tableau de Bord - Vétérinaire"; 
include 'partials/header.php'; 
?>
<link rel="stylesheet" href="/arcadia/public/css/veterinaire-dashboard.css"> <!-- Fichier CSS spécifique -->

<div class="main-container">
    <h1>Tableau de Bord Vétérinaire</h1>
    <div class="dashboard-cards">
        <a href="veterinaire_gestion_compte_rendus.php" class="card">
            <h2>Gérer les Comptes Rendus</h2>
            <p>Remplissez les comptes rendus pour chaque animal.</p>
        </a>
        <a href="veterinaire_gestion_habitats.php" class="card">
            <h2>Gérer les Habitats</h2>
            <p>Donnez votre avis sur les habitats du zoo.</p>
        </a>
        <a href="veterinaire_consultation_nourriture.php" class="card">
            <h2>Consulter la Nourriture</h2>
            <p>Consultez la consommation de nourriture des animaux.</p>
        </a>
    </div>
</div>

<?php include 'partials/footer.php'; ?>

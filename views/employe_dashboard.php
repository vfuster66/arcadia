<?php 
$title = "Tableau de Bord - Employé"; 
include 'partials/header.php'; 
?>
<link rel="stylesheet" href="/arcadia/public/css/employe-dashboard.css"> <!-- Fichier CSS spécifique pour l'employé -->

<div class="main-container">
    <h1>Tableau de Bord</h1>

    <div class="dashboard-cards">
        <a href="admin_gestion_services.php" class="card">
            <h2>Gestion des Services</h2>
            <p>Gérez les services offerts par le zoo.</p>
        </a>
        <a href="employe_gestion_nourriture.php" class="card">
            <h2>Gestion de la Nourriture</h2>
            <p>Gérez la consommation de nourriture des animaux.</p>
        </a>
        <a href="employe_gestion_avis.php" class="card">
            <h2>Gestion des Avis</h2>
            <p>Gérez les avis des visiteurs du zoo.</p>
        </a>
    </div>
</div>

<?php include 'partials/footer.php'; ?>


<?php 
$title = "Tableau de Bord - admin"; 
include 'partials/header.php'; 
?>
<link rel="stylesheet" href="/arcadia/public/css/admin-dashboard.css"> <!-- Fichier CSS spécifique pour l'administration -->

<div class="main-container">
    <h1>Tableau de Bord</h1>

    <!-- Section des statistiques -->
    <div class="statistics-section">
        <h2>Statistiques des Animaux Consultés</h2>
        <div class="statistics-cards">
            <div class="stat-card">
                <h3>Total des consultations</h3>
                <p>2500</p> <!-- Exemple de données, à remplacer par des données dynamiques -->
            </div>
            <div class="stat-card">
                <h3>Animal le plus consulté</h3>
                <p>Lion - Simba</p> <!-- Exemple de données -->
            </div>
            <div class="stat-card">
                <h3>Habitat le plus consulté</h3>
                <p>Savane</p> <!-- Exemple de données -->
            </div>
        </div>
    </div>
    <div class="dashboard-cards">
        <a href="admin_gestion_comptes.php" class="card">
            <h2>Gestion des Comptes</h2>
            <p>Créer, modifier, supprimer les comptes des utilisateurs.</p>
        </a>
        <a href="admin_gestion_services.php" class="card">
            <h2>Gestion des Services</h2>
            <p>Gérer les services offerts par le zoo.</p>
        </a>
        <a href="admin_gestion_habitats.php" class="card">
            <h2>Gestion des Habitats</h2>
            <p>Gérer les différents habitats du zoo.</p>
        </a>
        <a href="admin_gestion_animaux.php" class="card">
            <h2>Gestion des Animaux</h2>
            <p>Ajouter, modifier ou supprimer des animaux.</p>
        </a>
        <a href="admin_consultation_compte_rendus.php" class="card">
            <h2>Consultation des Comptes Rendus</h2>
            <p>Voir et filtrer les rapports des vétérinaires.</p>
        </a>
    </div>
</div>

<?php include 'partials/footer.php'; ?>

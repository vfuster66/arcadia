<?php 
$title = "Consultation des Comptes Rendus - Administrateur"; 
include 'partials/header.php'; 
?>
<link rel="stylesheet" href="/arcadia/public/css/admin-consultation-compte-rendus.css">

<div class="main-container">
    <h1>Consultation des Comptes Rendus</h1>

    <!-- Filtres -->
    <div class="filters">
        <input type="date" id="filter-date" placeholder="Filtrer par date...">
        <input type="text" id="filter-search" placeholder="Filtrer par vétérinaire, animal ou espèce...">
    </div>

    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Vétérinaire</th>
                <th>Animal</th>
                <th>Espèce</th>
                <th>Compte Rendu</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>15/08/2024</td>
                <td>Dr. Martin</td>
                <td>Simba</td>
                <td>Lion</td>
                <td><a href="#">Voir</a></td>
            </tr>
            <tr>
                <td>16/08/2024</td>
                <td>Dr. Dupont</td>
                <td>Nala</td>
                <td>Guépard</td>
                <td><a href="#">Voir</a></td>
            </tr>
            <tr>
                <td>17/08/2024</td>
                <td>Dr. Leroy</td>
                <td>Kara</td>
                <td>Crocodile</td>
                <td><a href="#">Voir</a></td>
            </tr>
            <tr>
                <td>18/08/2024</td>
                <td>Dr. Martin</td>
                <td>Zuri</td>
                <td>Zèbre</td>
                <td><a href="#">Voir</a></td>
            </tr>
            <tr>
                <td>19/08/2024</td>
                <td>Dr. Leroy</td>
                <td>Mara</td>
                <td>Éléphant</td>
                <td><a href="#">Voir</a></td>
            </tr>
            <tr>
                <td>20/08/2024</td>
                <td>Dr. Dupont</td>
                <td>Tami</td>
                <td>Girafe</td>
                <td><a href="#">Voir</a></td>
            </tr>
        </tbody>

    </table>
</div>

<?php include 'partials/footer.php'; ?>

<!-- Inclusion du fichier JavaScript -->
<script src="/arcadia/public/js/admin-consultation-compte-rendus.js"></script>

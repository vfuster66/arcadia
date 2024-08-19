<?php 
$title = "Gestion des Avis - Employé"; 
include 'partials/header.php'; 
?>
<link rel="stylesheet" href="/arcadia/public/css/employe-gestion-avis.css"> <!-- Fichier CSS spécifique pour la gestion des avis -->

<div class="main-container">
    <h1>Gestion des Avis</h1>
    <table>
        <thead>
            <tr>
                <th>Pseudo</th>
                <th>Avis</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <!-- Boucle sur les avis depuis la base de données -->
            <?php foreach ($avis as $avis_item): ?>
            <tr>
                <td><?php echo $avis_item['pseudo']; ?></td>
                <td><?php echo $avis_item['texte']; ?></td>
                <td>
                    <button class="btn-validate">Valider</button>
                    <button class="btn-invalidate">Invalider</button>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php include 'partials/footer.php'; ?>

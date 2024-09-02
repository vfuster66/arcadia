<?php 
$title = "Consultation de la Nourriture - Vétérinaire"; 
include 'partials/header.php'; 
?>
<link rel="stylesheet" href="/arcadia/public/css/veterinaire-consultation-nourriture.css"> <!-- Fichier CSS spécifique -->

<div class="main-container">
    <h1>Consultation de la Consommation de Nourriture</h1>
    <div class="two-column-layout">
        <form action="filter_nourriture.php" method="GET">
            <div class="form-group">
                <label for="animal">Sélectionner un Animal</label>
                <select id="animal" name="animal" required>
                    <!-- Options des animaux -->
                    <?php foreach ($animaux as $animal): ?>
                    <option value="<?php echo $animal['id']; ?>"><?php echo $animal['nom']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn-submit">Filtrer</button>
        </form>
        <div class="historique-container">
            <h2>Historique de la Consommation</h2>
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Heure</th>
                        <th>Type de Nourriture</th>
                        <th>Quantité (grammes)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($historique)): ?>
                        <?php foreach ($historique as $entry): ?>
                            <tr>
                                <td><?php echo $entry['date']; ?></td>
                                <td><?php echo $entry['time']; ?></td>
                                <td><?php echo $entry['nourriture']; ?></td>
                                <td><?php echo $entry['quantite']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4">Aucune entrée dans l'historique.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'partials/footer.php'; ?>

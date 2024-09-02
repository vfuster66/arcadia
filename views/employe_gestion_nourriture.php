<?php 
$title = "Gestion de la Nourriture - Employé"; 
include 'partials/header.php'; 
?>
<link rel="stylesheet" href="/arcadia/public/css/employe-gestion-nourriture.css"> <!-- Fichier CSS spécifique -->

<div class="main-container">
    <h1>Gestion de la Consommation de Nourriture</h1>

    <div class="two-column-layout">
        <!-- Colonne de gauche : Formulaire pour entrer les données -->
        <div class="left-column">
            <h2>Enregistrer une Consommation</h2>
            <form action="save_nourriture.php" method="POST">
                <div class="form-group">
                    <label for="animal">Sélectionner un Animal</label>
                    <select id="animal" name="animal" required>
                        <!-- Options des animaux -->
                        <?php foreach ($animaux as $animal): ?>
                        <option value="<?php echo $animal['id']; ?>"><?php echo $animal['nom']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="date">Date</label>
                    <input type="date" id="date" name="date" required>
                </div>
                <div class="form-group">
                    <label for="time">Heure</label>
                    <input type="time" id="time" name="time" required>
                </div>
                <div class="form-group">
                    <label for="nourriture">Type de Nourriture</label>
                    <input type="text" id="nourriture" name="nourriture" required>
                </div>
                <div class="form-group">
                    <label for="quantite">Quantité (grammes)</label>
                    <input type="number" id="quantite" name="quantite" required>
                </div>
                <button type="submit" class="btn-submit">Enregistrer</button>
            </form>
        </div>

        <!-- Colonne de droite : Historique -->
        <div class="right-column">
            <h2>Historique de la Consommation</h2>
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Heure</th>
                        <th>Animal</th>
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
                                <td><?php echo $entry['animal_name']; ?></td>
                                <td><?php echo $entry['nourriture']; ?></td>
                                <td><?php echo $entry['quantite']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5">Aucune entrée dans l'historique.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div> <!-- Fin de two-column-layout -->
</div>

<?php include 'partials/footer.php'; ?>

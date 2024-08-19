<?php 
$title = "Gestion des Comptes Rendus - Vétérinaire"; 
include 'partials/header.php'; 
?>
<link rel="stylesheet" href="/arcadia/public/css/veterinaire-gestion-compte-rendus.css"> <!-- Fichier CSS spécifique -->

<div class="main-container">
    <h1>Gérer les Comptes Rendus</h1>
    <form action="save_compte_rendu.php" method="POST">
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
            <label for="etat">État de l'Animal</label>
            <input type="text" id="etat" name="etat" required>
        </div>
        <div class="form-group">
            <label for="nourriture">Nourriture Proposée</label>
            <input type="text" id="nourriture" name="nourriture" required>
        </div>
        <div class="form-group">
            <label for="grammage">Grammage (grammes)</label>
            <input type="number" id="grammage" name="grammage" required>
        </div>
        <div class="form-group">
            <label for="date">Date de Passage</label>
            <input type="date" id="date" name="date" required>
        </div>
        <div class="form-group">
            <label for="details">Détails (facultatif)</label>
            <textarea id="details" name="details" rows="4"></textarea>
        </div>
        <button type="submit" class="btn-submit">Enregistrer</button>
    </form>
</div>

<?php include 'partials/footer.php'; ?>

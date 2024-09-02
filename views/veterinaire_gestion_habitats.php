<?php 
$title = "Gestion des Habitats - Vétérinaire"; 
include 'partials/header.php'; 
?>
<link rel="stylesheet" href="/arcadia/public/css/veterinaire-gestion-habitats.css"> <!-- Fichier CSS spécifique -->

<div class="main-container">
    <h1>Gérer les Habitats</h1>
    <form action="save_habitat_avis.php" method="POST">
        <div class="form-group">
            <label for="habitat">Sélectionner un Habitat</label>
            <select id="habitat" name="habitat" required>
                <!-- Options des habitats -->
                <?php foreach ($habitats as $habitat): ?>
                <option value="<?php echo $habitat['id']; ?>"><?php echo $habitat['nom']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="avis">Votre Avis</label>
            <textarea id="avis" name="avis" rows="5" required></textarea>
        </div>
        <button type="submit" class="btn-submit">Enregistrer</button>
    </form>
</div>

<?php include 'partials/footer.php'; ?>

<?php 
session_start();

// Activer l'affichage des erreurs
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Vérifier si l'utilisateur est un administrateur connecté
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: /arcadia/views/connexion.php');
    exit();
}

require_once __DIR__ . '/../config/db.php';

$title = "Gestion des Animaux - Administrateur"; 
include 'partials/header.php'; 

// Récupérer les animaux depuis la base de données
$query = "SELECT a.animal_id, a.prenom, a.species, a.details, a.etat, a.nourriture, a.quantite, a.dernier_controle_veterinaire, h.nom AS habitat
          FROM animal a
          LEFT JOIN detient d ON a.animal_id = d.animal_id
          LEFT JOIN habitat h ON d.habitat_id = h.habitat_id";
$stmt = $pdo->query($query);
$animaux = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Récupérer les habitats pour le formulaire
$habitat_query = $pdo->query("SELECT habitat_id, nom FROM habitat");
$habitats = $habitat_query->fetchAll(PDO::FETCH_ASSOC);
?>
<link rel="stylesheet" href="/arcadia/public/css/admin-gestion-animaux.css">

<div class="main-container">
    <h1>Gestion des Animaux</h1>

    <div class="two-column-layout">
        <!-- Formulaire de création d'un nouvel animal -->
        <div class="create-animal-container">
            <h2>Ajouter un Nouvel Animal</h2>
            <form action="/arcadia/controllers/save_animal.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="prenom">Nom de l'animal</label>
                    <input type="text" id="prenom" name="prenom" required>
                </div>
                <div class="form-group">
                    <label for="species">Espèce</label>
                    <input type="text" id="species" name="species" required>
                </div>
                <div class="form-group">
                    <label for="habitat">Habitat</label>
                    <select id="habitat" name="habitat_id" required>
                        <?php foreach ($habitats as $habitat): ?>
                            <option value="<?= htmlspecialchars($habitat['habitat_id']) ?>"><?= htmlspecialchars($habitat['nom']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="details">Détails</label>
                    <textarea id="details" name="details" rows="5" required></textarea>
                </div>
                <div class="form-group">
                    <label for="photo">Photo</label>
                    <input type="file" id="photo" name="photo" accept="image/*" required>
                </div>
                <button type="submit" class="btn-submit">Créer l'Animal</button>
            </form>
        </div>

        <!-- Liste des animaux existants avec filtres -->
        <div class="animal-list">
            <h2>Liste des Animaux</h2>

            <!-- Filtres -->
            <div class="filters">
                <input type="text" id="filter-search" placeholder="Rechercher par nom ou espèce...">
                <select id="filter-habitat">
                    <option value="">Tous les habitats</option>
                    <?php foreach ($habitats as $habitat): ?>
                        <option value="<?= htmlspecialchars($habitat['nom']) ?>"><?= htmlspecialchars($habitat['nom']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Liste d'animaux -->
            <div id="animal-list-container">
                <?php foreach ($animaux as $animal): ?>
                    <div class="animal-item" 
                         data-id="<?= htmlspecialchars($animal['animal_id']) ?>" 
                         data-name="<?= htmlspecialchars($animal['prenom']) ?>" 
                         data-species="<?= htmlspecialchars($animal['species']) ?>" 
                         data-habitat="<?= htmlspecialchars($animal['habitat']) ?>" 
                         data-details="<?= htmlspecialchars($animal['details']) ?>">
                        <h3><?= htmlspecialchars($animal['prenom']) ?> - <?= htmlspecialchars($animal['species']) ?> (<?= htmlspecialchars($animal['habitat']) ?>)</h3>
                        <button class="edit-animal">Modifier</button>
                        <button class="delete-animal">Supprimer</button>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div> <!-- Fin de two-column-layout -->
</div>

<!-- Modal de modification d'un animal -->
<div id="editAnimalModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Modifier l'Animal</h2>
        <form id="editAnimalForm" action="/arcadia/controllers/update_animal.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" id="edit-animal-id" name="animal_id">
            <div class="form-group">
                <label for="edit-animal-name">Nom de l'animal</label>
                <input type="text" id="edit-animal-name" name="prenom" required>
            </div>
            <div class="form-group">
                <label for="edit-animal-species">Espèce</label>
                <input type="text" id="edit-animal-species" name="species" required>
            </div>
            <div class="form-group">
                <label for="edit-animal-details">Détails</label>
                <textarea id="edit-animal-details" name="details" rows="5" required></textarea>
            </div>
            <div class="form-group">
                <label for="edit-animal-photo">Photo</label>
                <input type="file" id="edit-animal-photo" name="photo" accept="image/*">
                <div>
                    <img id="current-animal-photo" src="#" alt="Photo Actuelle" style="max-width: 100%; margin-top: 10px;">
                </div>
            </div>
            <button type="submit" class="btn-submit">Enregistrer les modifications</button>
            <button type="button" class="btn-cancel">Annuler</button>
        </form>
    </div>
</div>

<!-- Modal de suppression d'un animal -->
<div id="deleteAnimalModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Supprimer l'Animal</h2>
        <p>Êtes-vous sûr de vouloir supprimer cet animal ? Cette action est irréversible.</p>
        <form id="deleteAnimalForm" action="/arcadia/controllers/delete_animal.php" method="POST">
            <input type="hidden" id="delete-animal-id" name="animal_id">
            <button id="confirmDeleteAnimal" class="btn-submit">Supprimer</button>
            <button type="button" class="btn-cancel">Annuler</button>
        </form>
    </div>
</div>

<?php include 'partials/footer.php'; ?>

<!-- Inclusion du fichier JavaScript -->
<script src="/arcadia/public/js/admin-gestion-animaux.js"></script>

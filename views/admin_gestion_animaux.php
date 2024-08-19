<?php 
$title = "Gestion des Animaux - Administrateur"; 
include 'partials/header.php'; 
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
                    <label for="name">Nom de l'animal</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="species">Espèce</label>
                    <input type="text" id="species" name="species" required>
                </div>
                <div class="form-group">
                    <label for="habitat">Habitat</label>
                    <input type="text" id="habitat" name="habitat" required>
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
                    <option value="savane">Savane</option>
                    <option value="jungle">Jungle</option>
                    <option value="marais">Marais</option>
                    <!-- Ajouter d'autres habitats ici -->
                </select>
            </div>


            <!-- Liste d'animaux triée par habitat -->
            <div id="animal-list-container">
                <!-- Exemple d'un animal -->
                <div class="animal-item" data-name="Simba" data-species="Lion" data-habitat="savane">
                    <h3>Simba - Lion (Savane)</h3>
                    <button>Modifier</button>
                    <button>Supprimer</button>
                </div>
                <!-- Ajout d'un autre exemple d'animal -->
                <div class="animal-item" data-name="Mara" data-species="Éléphant" data-habitat="savane">
                    <h3>Mara - Éléphant (Savane)</h3>
                    <button>Modifier</button>
                    <button>Supprimer</button>
                </div>
                <div class="animal-item" data-name="Tami" data-species="Girafe" data-habitat="savane">
                    <h3>Tami - Girafe (Savane)</h3>
                    <button>Modifier</button>
                    <button>Supprimer</button>
                </div>
                <div class="animal-item" data-name="Zuri" data-species="Zèbre" data-habitat="savane">
                    <h3>Zuri - Zèbre (Savane)</h3>
                    <button>Modifier</button>
                    <button>Supprimer</button>
                </div>
                <div class="animal-item" data-name="Nala" data-species="Guépard" data-habitat="jungle">
                    <h3>Nala - Guépard (Jungle)</h3>
                    <button>Modifier</button>
                    <button>Supprimer</button>
                </div>
                <div class="animal-item" data-name="Kara" data-species="Crocodile" data-habitat="marais">
                    <h3>Kara - Crocodile (Marais)</h3>
                    <button>Modifier</button>
                    <button>Supprimer</button>
                </div>
            </div>
        </div>
    </div> <!-- Fin de two-column-layout -->
</div>

<!-- Modal de modification d'un animal -->
<div id="editAnimalModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Modifier l'Animal</h2>
        <form id="editAnimalForm">
            <div class="form-group">
                <label for="edit-animal-name">Nom de l'animal</label>
                <input type="text" id="edit-animal-name" name="edit-animal-name" required>
            </div>
            <div class="form-group">
                <label for="edit-animal-species">Espèce</label>
                <input type="text" id="edit-animal-species" name="edit-animal-species" required>
            </div>
            <div class="form-group">
                <label for="edit-animal-details">Détails</label>
                <textarea id="edit-animal-details" name="edit-animal-details" rows="5" required></textarea>
            </div>
            <div class="form-group">
                <label for="edit-animal-photo">Photo</label>
                <input type="file" id="edit-animal-photo" name="edit-animal-photo" accept="image/*">
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
        <button id="confirmDeleteAnimal" class="btn-submit">Supprimer</button>
        <button type="button" class="btn-cancel">Annuler</button>
    </div>
</div>


<?php include 'partials/footer.php'; ?>

<!-- Inclusion du fichier JavaScript -->
<script src="/arcadia/public/js/admin-gestion-animaux.js"></script>

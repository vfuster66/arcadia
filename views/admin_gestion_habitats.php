<?php 
$title = "Gestion des Habitats - Administrateur"; 
include 'partials/header.php'; 
?>
<link rel="stylesheet" href="/arcadia/public/css/admin-gestion-habitats.css">

<div class="main-container">
    <h1>Gestion des Habitats</h1>

    <div class="two-column-layout">
        <!-- Formulaire de création d'un habitat -->
        <div class="create-habitat-container">
            <h2>Ajouter un Habitat</h2>
            <div class="accordion">
                <div class="accordion-item">
                    <div class="accordion-header">
                        <h3>Informations sur l'Habitat</h3>
                    </div>
                    <div class="accordion-content">
                        <form action="/arcadia/controllers/save_habitat.php" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="main-image">Image Principale</label>
                                <input type="file" id="main-image" name="main-image" accept="image/*" required>
                            </div>
                            <div class="form-group">
                                <label for="title">Titre</label>
                                <input type="text" id="title" name="title" required>
                            </div>
                            <div class="form-group">
                                <label for="short-description">Description Rapide</label>
                                <input type="text" id="short-description" name="short-description" required>
                            </div>
                            <div class="form-group">
                                <label for="detailed-description">Description Détailée</label>
                                <textarea id="detailed-description" name="detailed-description" rows="5" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="secondary-images">Images Secondaires</label>
                                <input type="file" id="secondary-images" name="secondary-images[]" accept="image/*" multiple required>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="accordion-item">
                    <div class="accordion-header">
                        <h3>Informations sur les Animaux</h3>
                    </div>
                    <div class="accordion-content">
                        <div id="animals-container">
                            <!-- Exemple d'un animal -->
                            <div class="animal-entry">
                                <label for="animal-name-1">Nom de l'Animal</label>
                                <input type="text" id="animal-name-1" name="animal-name[]" required>

                                <label for="animal-species-1">Espèce</label>
                                <input type="text" id="animal-species-1" name="animal-species[]" required>

                                <label for="animal-details-1">Détails</label>
                                <textarea id="animal-details-1" name="animal-details[]" rows="2" required></textarea>

                                <label for="animal-photo-1">Photo</label>
                                <input type="file" id="animal-photo-1" name="animal-photo[]" accept="image/*" required>
                            </div>

                            <!-- Autres animaux peuvent être ajoutés dynamiquement via JavaScript -->
                        </div>
                        <button type="button" id="add-animal-btn">Ajouter un Animal</button>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn-submit">Enregistrer l'Habitat</button>
        </div>

        <!-- Liste des habitats existants avec filtres -->
        <div class="habitat-list">
            <h2>Liste des Habitats</h2>

            <!-- Liste d'habitats -->
            <div id="habitat-list-container">
                <!-- Exemple d'un habitat -->
                <div class="habitat-item" data-title="Savane" data-id="1" data-short-description="..." data-detailed-description="..." data-main-image="..." data-secondary-images='["image1.jpg", "image2.jpg"]' data-animals='[{"name":"Lion", "species":"Panthera leo"}]'>
                    <h3>Savane</h3>
                    <button>Modifier</button>
                    <button>Supprimer</button>
                </div>
                <!-- Ajouter d'autres habitats dynamiquement ici -->
            </div>
        </div>
    </div> <!-- Fin de two-column-layout -->
</div>

<!-- Modal de modification d'un habitat -->
<div id="editHabitatModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Modifier l'Habitat</h2>
        <div class="accordion">
            <div class="accordion-item">
                <div class="accordion-header">
                    <h3>Informations sur l'Habitat</h3>
                </div>
                <div class="accordion-content">
                    <form id="editHabitatForm" action="/arcadia/controllers/update_habitat.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="edit-main-image">Image Principale</label>
                            <input type="file" id="edit-main-image" name="edit-main-image" accept="image/*">
                            <img id="current-main-image" src="#" alt="Image Principale Actuelle" style="max-width: 100%; margin-top: 10px;">
                        </div>
                        <div class="form-group">
                            <label for="edit-title">Titre</label>
                            <input type="text" id="edit-title" name="edit-title" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-short-description">Description Rapide</label>
                            <input type="text" id="edit-short-description" name="edit-short-description" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-detailed-description">Description Détaillée</label>
                            <textarea id="edit-detailed-description" name="edit-detailed-description" rows="5" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="edit-secondary-images">Ajouter des Images Secondaires</label>
                            <input type="file" id="edit-secondary-images" name="edit-secondary-images[]" accept="image/*" multiple>
                            <div id="current-secondary-images" style="margin-top: 10px;">
                                <!-- Les images actuelles seront affichées ici avec un bouton de suppression -->
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="accordion-item">
                <div class="accordion-header">
                    <h3>Informations sur les Animaux</h3>
                </div>
                <div class="accordion-content">

                    <!-- Première Partie: Liste des Animaux Existants -->
                    <h4>Animaux Existants</h4>
                    <div id="edit-animals-list">
                        <div class="animal-item">
                            <h4>Simba - Lion</h4>
                            <button class="btn-delete-animal">Supprimer</button>
                        </div>
                        <div class="animal-item">
                            <h4>Baloo - Ours</h4>
                            <button class="btn-delete-animal">Supprimer</button>
                        </div>
                        <div class="animal-item">
                            <h4>Dumbo - Éléphant</h4>
                            <button class="btn-delete-animal">Supprimer</button>
                        </div>
                    </div>


                    <!-- Deuxième Partie: Ajouter un Nouvel Animal -->
                    <h4>Ajouter un Nouvel Animal</h4>
                    <div id="add-new-animal-form">
                        <div class="form-group">
                            <label for="new-animal-name">Nom de l'Animal</label>
                            <input type="text" id="new-animal-name" name="new-animal-name" required>
                        </div>
                        <div class="form-group">
                            <label for="new-animal-species">Espèce</label>
                            <input type="text" id="new-animal-species" name="new-animal-species" required>
                        </div>
                        <div class="form-group">
                            <label for="new-animal-details">Détails</label>
                            <textarea id="new-animal-details" name="new-animal-details" rows="2" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="new-animal-photo">Photo</label>
                            <input type="file" id="new-animal-photo" name="new-animal-photo" accept="image/*" required>
                        </div>
                        <button type="button" id="add-new-animal-btn" class="btn-submit">Ajouter l'Animal</button>
                    </div>
                </div>
            </div>

        </div>
        <button type="submit" class="btn-submit">Enregistrer les modifications</button>
        <button type="button" class="btn-cancel">Annuler</button>
    </div>
</div>

<!-- Modal de suppression d'un habitat -->
<div id="deleteHabitatModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Supprimer l'Habitat</h2>
        <p>Êtes-vous sûr de vouloir supprimer cet habitat ? Cette action est irréversible.</p>
        <button id="confirmDeleteHabitat" class="btn-submit">Supprimer</button>
        <button type="button" class="btn-cancel">Annuler</button>
    </div>
</div>

<!-- Modal pour prévisualiser l'image principale -->
<div id="imagePreviewModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <img id="preview-image" src="#" alt="Aperçu de l'image" style="max-width: 100%;">
    </div>
</div>

<?php include 'partials/footer.php'; ?>

<!-- Inclusion du fichier JavaScript -->
<script src="/arcadia/public/js/admin-gestion-habitats.js"></script>

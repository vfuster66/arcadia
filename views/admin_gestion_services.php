<?php 
$title = "Gestion des Services - Administrateur"; 
include 'partials/header.php'; 
?>
<link rel="stylesheet" href="/arcadia/public/css/admin-gestion-services.css">

<div class="main-container">
    <h1>Gestion des Services</h1>

    <div class="two-column-layout">
        <!-- Formulaire de création d'un service -->
        <div class="create-service-container">
            <h2>Ajouter un Service</h2>
            <div class="accordion">
                <div class="accordion-item">
                    <div class="accordion-header">
                        <h3>Informations sur le Service</h3>
                    </div>
                    <div class="accordion-content">
                        <form action="/arcadia/controllers/save_service.php" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="service-name">Nom du Service</label>
                                <input type="text" id="service-name" name="service-name" required>
                            </div>
                            <div class="form-group">
                                <label for="service-description">Description</label>
                                <textarea id="service-description" name="service-description" rows="5" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="service-image">Image du Service</label>
                                <input type="file" id="service-image" name="service-image" accept="image/*" required>
                            </div>
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <h3>Informations supplémentaires</h3>
                                </div>
                                <div class="accordion-content">
                                    <div id="extra-info-container">
                                        <!-- Exemple d'information supplémentaire -->
                                        <div class="extra-info-item">
                                            <label for="extra-title-1">Titre de l'information</label>
                                            <input type="text" id="extra-title-1" name="extra-title[]" required>
                                            
                                            <label for="extra-text-1">Texte</label>
                                            <textarea id="extra-text-1" name="extra-text[]" rows="2" required></textarea>
                                        </div>
                                    </div>
                                    <button type="button" id="add-extra-info-btn">Ajouter une Information Supplémentaire</button>
                                </div>
                            </div>
                            <button type="submit" class="btn-submit">Créer le Service</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Liste des services existants avec filtres -->
        <div class="service-list">
            <h2>Liste des Services</h2>

            <div id="service-list-container">
                <!-- Exemple d'un service -->
                <div class="service-item" data-id="1" data-name="Service 1" data-description="Description du service 1" data-image="path/to/image.jpg">
                    <h3>Service 1</h3>
                    <button class="btn-edit">Modifier</button>
                    <button class="btn-delete">Supprimer</button>
                </div>
            </div>
        </div>
    </div> <!-- Fin de two-column-layout -->
</div>

<!-- Modal de modification d'un service -->
<div id="editServiceModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Modifier le Service</h2>
        <form id="editServiceForm">
            <div class="accordion">
                <div class="accordion-item">
                    <div class="accordion-header">
                        <h3>Informations sur le Service</h3>
                    </div>
                    <div class="accordion-content">
                        <div class="form-group">
                            <label for="edit-service-name">Nom du Service</label>
                            <input type="text" id="edit-service-name" name="edit-service-name" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-service-description">Description</label>
                            <textarea id="edit-service-description" name="edit-service-description" rows="5" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="edit-service-image">Image du Service</label>
                            <input type="file" id="edit-service-image" name="edit-service-image" accept="image/*">
                            <div>
                                <a href="#" id="view-service-image" target="_blank">Voir l'image actuelle</a>
                            </div>
                            <img id="current-service-image" src="#" alt="Image du Service" style="max-width: 100%; margin-top: 10px;">
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <div class="accordion-header">
                        <h3>Informations supplémentaires</h3>
                    </div>
                    <div class="accordion-content">
                        <div id="edit-extra-info-container">
                            <!-- Les informations supplémentaires actuelles seront affichées ici -->
                        </div>
                        <button type="button" id="add-edit-extra-info-btn">Ajouter une Information Supplémentaire</button>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn-submit">Enregistrer les modifications</button>
            <button type="button" class="btn-cancel">Annuler</button>
        </form>
    </div>
</div>

<!-- Modal de suppression d'un service -->
<div id="deleteServiceModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Supprimer le Service</h2>
        <p>Êtes-vous sûr de vouloir supprimer ce service ? Cette action est irréversible.</p>
        <button id="confirmDeleteService" class="btn-submit">Supprimer</button>
        <button type="button" class="btn-cancel">Annuler</button>
    </div>
</div>

<?php include 'partials/footer.php'; ?>

<!-- Inclusion du fichier JavaScript -->
<script src="/arcadia/public/js/admin-gestion-services.js"></script>

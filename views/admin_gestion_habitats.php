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

$title = "Gestion des Habitats - admin"; 
include 'partials/header.php'; 
require_once __DIR__ . '/../config/db.php';  // Connexion à la base de données
?>
<link rel="stylesheet" href="/arcadia/public/css/admin-gestion-habitats.css">

<div class="main-container">
    <h1>Gestion des Habitats</h1>

    <div class="two-column-layout">

        <!-- Formulaire de création d'un habitat -->
        <div class="create-habitat-container">
            <h2>Ajouter un Habitat</h2>
            <form action="/arcadia/controllers/save_habitat.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="title">Titre</label>
                    <input type="text" id="title" name="title" required>
                </div>
                <div class="form-group">
                    <label for="short-description">Description Rapide</label>
                    <input type="text" id="short-description" name="short-description" required>
                </div>
                <div class="form-group">
                    <label for="main-image">Image Principale</label>
                    <input type="file" id="main-image" name="main-image" accept="image/*" required>
                </div>
                <div class="form-group">
                    <label for="detailed-description">Description Détaillée</label>
                    <textarea id="detailed-description" name="detailed-description" rows="5" required></textarea>
                </div>
                <div class="form-group">
                    <label for="secondary-images">Images Secondaires (maximum 5)</label>
                    <input type="file" id="secondary-images" name="secondary_images[]" accept="image/*" multiple>
                </div>
                <button type="submit" class="btn-submit">Enregistrer l'Habitat</button>
            </form>
        </div>

        <!-- Liste des habitats existants avec filtres -->
        <div class="habitat-list">
            <h2>Liste des Habitats</h2>

            <!-- Liste d'habitats -->
            <div id="habitat-list-container">
                <?php
                // Récupérer les habitats et leurs images secondaires
                $query = "
                SELECT 
                    h.habitat_id, 
                    h.nom, 
                    h.description_rapide, 
                    h.description_detaillee, 
                    h.image_principale_url,
                    json_agg(json_build_object(
                        'secondary_image_id', si.secondary_image_id, 
                        'secondary_image_url', si.secondary_image_url
                    )) AS secondary_images
                FROM habitat h
                LEFT JOIN secondary_images si ON h.habitat_id = si.habitat_id
                GROUP BY h.habitat_id, h.nom, h.description_rapide, h.description_detaillee, h.image_principale_url";
                $stmt = $pdo->query($query);
                $habitats = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($habitats as $habitat) {
                    $habitatId = htmlspecialchars($habitat['habitat_id']);
                    $nom = htmlspecialchars($habitat['nom']);
                    $descriptionRapide = htmlspecialchars($habitat['description_rapide']);
                    $descriptionDetaillee = htmlspecialchars($habitat['description_detaillee']);
                    $imagePrincipale = htmlspecialchars($habitat['image_principale_url']);
                    $secondaryImages = htmlspecialchars(json_encode($habitat['secondary_images'], JSON_UNESCAPED_SLASHES));

                    echo '<div class="habitat-item" data-id="' . $habitatId . '" 
                        data-main-image="' . $imagePrincipale . '"
                        data-secondary-images=\'' . $secondaryImages . '\'
                        data-short-description="' . $descriptionRapide . '"
                        data-detailed-description="' . $descriptionDetaillee . '">';
                    echo '<h3>' . $nom . '</h3>';
                    echo '<button class="edit-habitat" data-id="' . $habitatId . '">Modifier</button>';
                    echo '<button class="delete-habitat" data-id="' . $habitatId . '">Supprimer</button>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </div> <!-- Fin de two-column-layout -->
</div>

<!-- Modal de modification d'un habitat -->
<div id="editHabitatModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Modifier l'Habitat</h2>
        <form id="editHabitatForm" action="/arcadia/controllers/update_habitat.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="edit-title">Titre</label>
                <input type="text" id="edit-title" name="edit-title" required>
            </div>
            <div class="form-group">
                <label for="edit-short-description">Description Rapide</label>
                <input type="text" id="edit-short-description" name="edit-short-description" required>
            </div>
            <div class="form-group">
                <label for="edit-main-image">Image Principale</label>
                <input type="file" id="edit-main-image" name="edit-main-image" accept="image/*">
                <img id="current-main-image" src="#" alt="Image Principale Actuelle" style="max-width: 100%; margin-top: 10px;">
            </div>
            <div class="form-group">
                <label for="edit-detailed-description">Description Détaillée</label>
                <textarea id="edit-detailed-description" name="edit-detailed-description" rows="5" required></textarea>
            </div>
            <div class="form-group">
                <label for="edit-secondary-images">Images Secondaires</label>
                <input type="file" id="edit-secondary-images" name="edit-secondary-images[]" accept="image/*" multiple>
                <div id="current-secondary-images">
                    <!-- Images secondaires actuelles seront chargées ici -->
                </div>
            </div>
            <button type="submit" class="btn-submit">Enregistrer les modifications</button>
        </form>
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

<!-- Modal pour prévisualiser les images secondaires -->
<div id="secondaryImagePreviewModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <img id="secondary-preview-image" src="#" alt="Aperçu de l'image secondaire" style="max-width: 100%;">
    </div>
</div>

<?php include 'partials/footer.php'; ?>

<!-- Inclusion du fichier JavaScript -->
<script src="/arcadia/public/js/admin-gestion-habitats.js"></script>

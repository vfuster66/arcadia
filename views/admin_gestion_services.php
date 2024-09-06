<?php 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<?php 
// Activer l'affichage des erreurs
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Vérifier si l'utilisateur est un administrateur connecté
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: /arcadia/views/connexion.php');
    exit();
}

$title = "Gestion des Services - Administrateur"; 
include 'partials/header.php'; 

require_once '../config/db.php'; // Connexion à la base de données

// Récupérer tous les services depuis la base de données
$query = "SELECT * FROM service";
$stmt = $pdo->prepare($query);
$stmt->execute();
$services = $stmt->fetchAll(PDO::FETCH_ASSOC); // Stocke les services dans un tableau

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
                                <label for="service-type">Type de Service</label>
                                <input type="text" id="service-type" name="service-type" required>
                            </div>
                            <div class="form-group">
                                <label for="service-horaires">Horaires</label>
                                <textarea id="service-horaires" name="service-horaires" rows="2" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="service-prix">Prix</label>
                                <input type="number" id="service-prix" name="service-prix" step="0.01" required>
                            </div>
                            <div class="form-group">
                                <label for="service-image">Image du Service</label>
                                <input type="file" id="service-image" name="service-image" accept="image/*" required>
                            </div>

                            <!-- Informations supplémentaires liées à service_details -->
                            <div class="accordion-item">
                                <div class="accordion-header">
                                    <h3>Informations supplémentaires</h3>
                                </div>
                                <div class="accordion-content">
                                    <div id="extra-info-container">
                                        <div class="extra-info-item">
                                            <label for="extra-title-1">Titre de l'information</label>
                                            <input type="text" id="extra-title-1" name="extra-title[]" required>

                                            <label for="extra-text-1">Texte</label>
                                            <textarea id="extra-text-1" name="extra-text[]" rows="2" required></textarea>

                                            <label for="extra-image-1">Image de la section</label>
                                            <input type="file" id="extra-image-1" name="extra-image[]" accept="image/*">
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
                <?php if (count($services) > 0): ?>
                    <?php foreach ($services as $service): ?>
                        <?php
                        // Requête pour récupérer les détails supplémentaires
                        $details_query = "SELECT * FROM service_details WHERE service_id = :service_id";
                        $details_stmt = $pdo->prepare($details_query);
                        $details_stmt->execute(['service_id' => $service['service_id']]);
                        $service_details = $details_stmt->fetchAll(PDO::FETCH_ASSOC);
                        $details_json = json_encode($service_details, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP); // Echappe les caractères spéciaux
                        ?>
                        <div class="service-item" 
                            data-id="<?= htmlspecialchars($service['service_id']) ?>" 
                            data-name="<?= htmlspecialchars($service['nom']) ?>"
                            data-description="<?= htmlspecialchars($service['description']) ?>"
                            data-type="<?= htmlspecialchars($service['type']) ?>"
                            data-horaires="<?= htmlspecialchars($service['horaires']) ?>"
                            data-prix="<?= htmlspecialchars($service['prix']) ?>"
                            data-image="<?= htmlspecialchars($service['image_id']) ?>"
                            data-details='<?= $details_json ?>'>
                            <h3><?= htmlspecialchars($service['nom']) ?></h3>
                            <button class="btn-edit">Modifier</button>
                            <button class="btn-delete">Supprimer</button>
                        </div>
                    <?php endforeach; ?>

                <?php else: ?>
                    <p>Aucun service n'a encore été créé.</p>
                <?php endif; ?>
            </div>
        </div>
    </div> <!-- Fin de two-column-layout -->
</div>

<!-- Modal de modification d'un service -->
<div id="editServiceModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Modifier le Service</h2>
        <form id="editServiceForm" action="/arcadia/controllers/update_service.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" id="edit-service-id" name="edit-service-id"> <!-- Stocke l'ID du service à modifier -->
            
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
                        <label for="edit-service-type">Type de Service</label>
                        <input type="text" id="edit-service-type" name="edit-service-type" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-service-horaires">Horaires</label>
                        <textarea id="edit-service-horaires" name="edit-service-horaires" rows="2" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="edit-service-prix">Prix</label>
                        <input type="number" id="edit-service-prix" name="edit-service-prix" step="0.01" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-service-image">Image du Service</label>
                        <input type="file" id="edit-service-image" name="edit-service-image" accept="image/*">
                        <img id="current-service-image" src="#" alt="Image du Service" style="max-width: 100%; margin-top: 10px;">
                    </div>
                </div>
            </div>

            <!-- Informations supplémentaires -->
            <div class="accordion-item">
                <div class="accordion-header">
                    <h3>Informations supplémentaires</h3>
                </div>
                <div class="accordion-content">
                    <div id="edit-extra-info-container">
                        <!-- Les informations supplémentaires existantes seront affichées ici -->
                    </div>
                    <button type="button" id="add-edit-extra-info-btn">Ajouter une Information Supplémentaire</button>
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
        <form action="/arcadia/controllers/delete_service.php" method="POST">
            <input type="hidden" id="delete-service-id" name="delete-service-id">
            <button type="submit" id="confirmDeleteService" class="btn-submit">Supprimer</button>
            <button type="button" class="btn-cancel">Annuler</button>
        </form>
    </div>
</div>

<?php include 'partials/footer.php'; ?>

<!-- Inclusion du fichier JavaScript -->
<script src="/arcadia/public/js/admin-gestion-services.js"></script>

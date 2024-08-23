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
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../services/MailService.php';

$title = "Gestion des comptes - admin"; 
include 'partials/header.php'; 

$userModel = new User($pdo);
$users = $userModel->getAllUsers();

?>

<link rel="stylesheet" href="/arcadia/public/css/admin-gestion-comptes.css"> <!-- Fichier CSS spécifique pour l'administration -->

<div class="main-container">
    <h1>Gestion des Comptes</h1>

    <div class="two-column-layout">
        <!-- Formulaire de création d'un compte -->
        <div class="create-account-container">
            <h2>Ajouter un Compte</h2>
            <form action="/arcadia/controllers/save_account.php" method="POST">
                <div class="form-group">
                    <label for="name">Nom d'utilisateur</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Adresse e-mail</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <div class="form-group">
                    <label for="prenom">Prénom</label>
                    <input type="text" id="prenom" name="prenom" required>
                </div>

                <div class="form-group">
                    <label for="nom">Nom</label>
                    <input type="text" id="nom" name="nom" required>
                </div>
                <div class="form-group select-role-container">
                    <label for="role">Rôle</label>
                    <select id="role" name="role" required>
                        <option value="employe">Employé</option>
                        <option value="veterinaire">Vétérinaire</option>
                    </select>
                </div>
                <button type="submit" class="btn-submit">Enregistrer le Compte</button>
            </form>
        </div>

        <!-- Liste des comptes existants avec filtres -->
        <div class="account-list">
            <h2>Liste des Comptes</h2>

            <!-- Filtres -->
            <div class="filters">
                <input type="text" id="filter-search" placeholder="Rechercher par nom ou e-mail...">
                <select id="filter-role">
                    <option value="">Tous les rôles</option>
                    <option value="employe">Employé</option>
                    <option value="veterinaire">Vétérinaire</option>
                </select>
            </div>

            <!-- Liste des comptes -->
            <div id="account-list-container">
                <?php foreach ($users as $user): ?>
                    <div class="account-item" 
                        data-id="<?= htmlspecialchars($user['user_id']) ?>" 
                        data-name="<?= htmlspecialchars($user['username']) ?>" 
                        data-email="<?= htmlspecialchars($user['email']) ?>" 
                        data-role="<?= htmlspecialchars($user['role']) ?>"
                        data-nom="<?= htmlspecialchars($user['nom']) ?>" 
                        data-prenom="<?= htmlspecialchars($user['prenom']) ?>">
                        <h3><?= htmlspecialchars($user['username']) ?> - <?= htmlspecialchars($user['role']) ?> (<?= htmlspecialchars($user['email']) ?>)</h3>
                        <button class="btn-edit">Modifier</button>
                        <?php if ($user['role'] !== 'admin'): ?>
                            <button class="btn-delete" data-id="<?= htmlspecialchars($user['user_id']) ?>">Supprimer</button>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>
    </div> <!-- Fin de two-column-layout -->
</div>

<!-- Modal de modification -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Modifier le Compte</h2>
        <form action="/arcadia/controllers/update_account.php" method="POST">
            <div class="form-group">
                <label for="edit-name">Nom d'utilisateur</label>
                <input type="text" id="edit-name" name="name" required>
            </div>
            <div class="form-group">
                <label for="edit-prenom">Prénom</label>
                <input type="text" id="edit-prenom" name="prenom" required>
            </div>
            <div class="form-group">
                <label for="edit-nom">Nom</label>
                <input type="text" id="edit-nom" name="nom" required>
            </div>

            <div class="form-group">
                <label for="edit-email">Adresse e-mail</label>
                <input type="email" id="edit-email" name="email" required disabled>
            </div>

            <div class="form-group">
                <label for="edit-password">Mot de passe</label>
                <input type="password" id="edit-password" name="password">
            </div>
            <div class="form-group select-role-container">
                <label for="edit-role">Rôle</label>
                <select id="edit-role" name="role" required>
                    <option value="employe">Employé</option>
                    <option value="veterinaire">Vétérinaire</option>
                </select>
            </div>
            <input type="hidden" id="edit-user-id" name="user_id"> <!-- Champ caché pour l'ID de l'utilisateur -->
            <button type="submit" class="btn-submit">Enregistrer les modifications</button>
        </form>
    </div>
</div>


<!-- Modal pour la suppression de compte -->
<div id="deleteModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Supprimer le Compte</h2>
        <p>Êtes-vous sûr de vouloir supprimer ce compte? Cette action est irréversible et toutes les données associées seront perdues.</p>
        <form id="delete-account-form" action="/arcadia/controllers/delete_account.php" method="POST">
            <input type="hidden" id="delete-account-id" name="account_id">
            <button type="submit" class="btn-submit">Supprimer</button>
            <button type="button" class="btn-cancel">Annuler</button>
        </form>
    </div>
</div>

<?php include 'partials/footer.php'; ?>

<!-- Inclusion du fichier JavaScript -->
<script src="/arcadia/public/js/admin-gestion-comptes.js"></script>

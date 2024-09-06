<?php
session_start();

// Activer l'affichage des erreurs
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Récupérer les données du formulaire
        $serviceId = $_POST['edit-service-id'];
        $nom = $_POST['edit-service-name'];
        $description = $_POST['edit-service-description'];
        $type = $_POST['edit-service-type'];
        $horaires = $_POST['edit-service-horaires'];
        $prix = $_POST['edit-service-prix'];

        // Gérer l'image si elle a été téléchargée
        if (!empty($_FILES['edit-service-image']['name'])) {
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            $fileType = mime_content_type($_FILES['edit-service-image']['tmp_name']);
            
            if (in_array($fileType, $allowedTypes)) {
                $imagePath = '/arcadia/public/images/divers/' . basename($_FILES['edit-service-image']['name']);
                move_uploaded_file($_FILES['edit-service-image']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . $imagePath);
                
                // Mettre à jour l'image du service dans la base de données
                $updateImageQuery = "UPDATE service SET image_id = :image_id WHERE service_id = :service_id";
                $stmt = $pdo->prepare($updateImageQuery);
                $stmt->execute([
                    ':image_id' => $imagePath,
                    ':service_id' => $serviceId,
                ]);
            } else {
                die('Type de fichier non supporté.');
            }
        }

        // Mise à jour du service dans la table `service`
        $updateServiceQuery = "UPDATE service SET nom = :nom, description = :description, type = :type, horaires = :horaires, prix = :prix, updated_at = NOW() WHERE service_id = :service_id";
        $stmt = $pdo->prepare($updateServiceQuery);
        $stmt->execute([
            ':nom' => $nom,
            ':description' => $description,
            ':type' => $type,
            ':horaires' => $horaires,
            ':prix' => $prix,
            ':service_id' => $serviceId,
        ]);

        // Mettre à jour les informations supplémentaires dans la table `service_details`
        $deleteOldDetailsQuery = "DELETE FROM service_details WHERE service_id = :service_id";
        $stmt = $pdo->prepare($deleteOldDetailsQuery);
        $stmt->execute([':service_id' => $serviceId]);

        // Insertion des nouvelles informations supplémentaires
        foreach ($_POST['extra-title'] as $index => $title) {
            $content = $_POST['extra-text'][$index];
            $imagePath = null;

            // Gérer les images supplémentaires si elles sont envoyées
            if (!empty($_FILES['extra-image']['name'][$index])) {
                $imagePath = '/arcadia/public/images/details/' . basename($_FILES['extra-image']['name'][$index]);
                move_uploaded_file($_FILES['extra-image']['tmp_name'][$index], $_SERVER['DOCUMENT_ROOT'] . $imagePath);
            }

            $detailQuery = "INSERT INTO service_details (service_id, section_title, section_content, image_path) VALUES (:service_id, :section_title, :section_content, :image_path)";
            $stmt = $pdo->prepare($detailQuery);
            $stmt->execute([
                ':service_id' => $serviceId,
                ':section_title' => $title,
                ':section_content' => $content,
                ':image_path' => $imagePath,
            ]);
        }

        // Redirection après la mise à jour
        header('Location: /arcadia/views/admin_gestion_services.php?status=success');
        exit();
    } catch (Exception $e) {
        // En cas d'erreur, affiche un message ou redirige vers une page d'erreur
        echo 'Erreur : ' . $e->getMessage();
    }
}
?>

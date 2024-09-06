<?php
session_start();

// Activer l'affichage des erreurs
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer l'ID du service à supprimer
    $serviceId = $_POST['delete-service-id'];

    // Supprimer les détails du service
    $deleteDetailsQuery = "DELETE FROM service_details WHERE service_id = :service_id";
    $stmt = $pdo->prepare($deleteDetailsQuery);
    $stmt->execute([':service_id' => $serviceId]);

    // Supprimer le service lui-même
    $deleteServiceQuery = "DELETE FROM service WHERE service_id = :service_id";
    $stmt = $pdo->prepare($deleteServiceQuery);
    $stmt->execute([':service_id' => $serviceId]);

    // Redirection après la suppression
    header('Location: /arcadia/views/admin-gestion-services.php');
    exit();
}
?>

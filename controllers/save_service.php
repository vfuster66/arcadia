<?php
session_start();

// Activer l'affichage des erreurs
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../config/db.php';

// Insertion dans la table `service`
$nom = $_POST['service-name'];
$description = $_POST['service-description'];
$type = $_POST['service-type'];
$horaires = $_POST['service-horaires'];
$prix = $_POST['service-prix'];
$imagePath = '/arcadia/public/images/divers/' . basename($_FILES['main-image']['name']);

$query = "INSERT INTO service (nom, description, type, horaires, prix, image_id, created_at) VALUES (:nom, :description, :type, :horaires, :prix, :image_id, NOW())";
$stmt = $pdo->prepare($query);
$stmt->execute([
    ':nom' => $nom,
    ':description' => $description,
    ':type' => $type,
    ':horaires' => $horaires,
    ':prix' => $prix,
    ':image_id' => $imagePath,
]);

// Récupérer l'ID du service nouvellement inséré
$serviceId = $pdo->lastInsertId();

// Insertion dans la table `service_details`
foreach ($_POST['extra-title'] as $index => $title) {
    $content = $_POST['extra-text'][$index];
    $detailQuery = "INSERT INTO service_details (service_id, section_title, section_content) VALUES (:service_id, :section_title, :section_content)";
    $stmt = $pdo->prepare($detailQuery);
    $stmt->execute([
        ':service_id' => $serviceId,
        ':section_title' => $title,
        ':section_content' => $content,
    ]);
}

header('Location: /arcadia/views/admin-gestion-services.php');

?>

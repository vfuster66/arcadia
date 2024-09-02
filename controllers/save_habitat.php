<?php
require_once __DIR__ . '/../config/db.php';

// Récupération des données du formulaire
$nom = $_POST['title'];
$description_rapide = $_POST['short-description'];
$description_detaillee = $_POST['detailed-description'];

// Gestion de l'image principale
$image_principale_url = null;
if (!empty($_FILES['main-image']['name'])) {
    $image_principale_path = '/arcadia/public/images/habitats/' . basename($_FILES['main-image']['name']);
    move_uploaded_file($_FILES['main-image']['tmp_name'], $image_principale_path);
    $image_principale_url = $image_principale_path;
}

// Insertion de l'habitat dans la base de données
$query = "INSERT INTO habitat (nom, description_rapide, description_detaillee, image_principale_url) 
        VALUES (:nom, :description_rapide, :description_detaillee, :image_principale_url)";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':nom', $nom);
$stmt->bindParam(':description_rapide', $description_rapide);
$stmt->bindParam(':description_detaillee', $description_detaillee);
$stmt->bindParam(':image_principale_url', $image_principale_url);
$stmt->execute();

// Récupérer l'ID de l'habitat nouvellement créé
$habitat_id = $pdo->lastInsertId();

// Gestion des images secondaires
for ($i = 0; $i < 5; $i++) {
    if (!empty($_FILES['secondary_images']['name'][$i])) {
        $secondary_image_path = '/arcadia/public/images/habitats/' . basename($_FILES['secondary_images']['name'][$i]);
        move_uploaded_file($_FILES['secondary_images']['tmp_name'][$i], $secondary_image_path);

        // Insérer chaque image secondaire dans la table 'image_secondary'
        $query = "INSERT INTO image_secondary (habitat_id, image_url) VALUES (:habitat_id, :image_url)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':habitat_id', $habitat_id, PDO::PARAM_INT);
        $stmt->bindParam(':image_url', $secondary_image_path);
        $stmt->execute();
    }
}

// Redirection après l'insertion
header('Location: /arcadia/views/admin_gestion_habitats.php');
exit();
?>

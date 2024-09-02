<?php
require_once __DIR__ . '/../config/db.php';

// Récupérer les données du formulaire de modification
$habitat_id = $_POST['habitat_id'];
$nom = $_POST['edit-title'];
$description_rapide = $_POST['edit-short-description'];
$description_detaillee = $_POST['edit-detailed-description'];

// Gestion de l'image principale (si elle est modifiée)
if (!empty($_FILES['edit-main-image']['name'])) {
    $image_principale_url = '/arcadia/public/images/habitats/' . basename($_FILES['edit-main-image']['name']);
    move_uploaded_file($_FILES['edit-main-image']['tmp_name'], $image_principale_url);

    // Mettre à jour l'image principale dans l'habitat
    $query = "UPDATE habitat SET image_principale_url = :image_principale_url WHERE habitat_id = :habitat_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':image_principale_url', $image_principale_url);
    $stmt->bindParam(':habitat_id', $habitat_id, PDO::PARAM_INT);
    $stmt->execute();
}

// Mettre à jour les autres informations de l'habitat
$query = "UPDATE habitat SET nom = :nom, description_rapide = :description_rapide, description_detaillee = :description_detaillee 
        WHERE habitat_id = :habitat_id";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':nom', $nom);
$stmt->bindParam(':description_rapide', $description_rapide);
$stmt->bindParam(':description_detaillee', $description_detaillee);
$stmt->bindParam(':habitat_id', $habitat_id, PDO::PARAM_INT);
$stmt->execute();

// Gestion des images secondaires (si elles sont modifiées)
for ($i = 0; $i < 5; $i++) {
    if (!empty($_FILES['edit-secondary-images']['name'][$i])) {
        $secondary_image_path = '/arcadia/public/images/habitats/' . basename($_FILES['edit-secondary-images']['name'][$i]);
        move_uploaded_file($_FILES['edit-secondary-images']['tmp_name'][$i], $secondary_image_path);

        // Vérifier si une image secondaire existe déjà pour cet index
        $query = "SELECT image_id FROM image_secondary WHERE habitat_id = :habitat_id LIMIT 1 OFFSET :offset";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':habitat_id', $habitat_id, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $i, PDO::PARAM_INT);
        $stmt->execute();
        $existing_image_id = $stmt->fetchColumn();

        if ($existing_image_id) {
            // Mettre à jour l'image secondaire existante
            $query = "UPDATE image_secondary SET image_url = :image_url WHERE image_id = :image_id";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':image_url', $secondary_image_path);
            $stmt->bindParam(':image_id', $existing_image_id, PDO::PARAM_INT);
            $stmt->execute();
        } else {
            // Ajouter une nouvelle image secondaire
            $query = "INSERT INTO image_secondary (habitat_id, image_url) VALUES (:habitat_id, :image_url)";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':habitat_id', $habitat_id, PDO::PARAM_INT);
            $stmt->bindParam(':image_url', $secondary_image_path);
            $stmt->execute();
        }
    }
}

// Redirection après la mise à jour
header('Location: /arcadia/views/admin_gestion_habitats.php');
exit();

?>

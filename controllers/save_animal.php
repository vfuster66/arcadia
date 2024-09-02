<?php
require_once __DIR__ . '/../config/db.php';

$prenom = $_POST['prenom'];
$species = $_POST['species'];
$details = $_POST['details'];
$habitat_id = $_POST['habitat_id'];
$image_path = null;

// Gestion de l'image
if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
    $image_path = '/arcadia/public/images/animaux/' . basename($_FILES['photo']['name']);
    move_uploaded_file($_FILES['photo']['tmp_name'], __DIR__ . '/../public/images/animaux/' . basename($_FILES['photo']['name']));
}

// Insertion dans la base de données
$query = "INSERT INTO animal (prenom, species, details, habitat_id, image_id) VALUES (:prenom, :species, :details, :habitat_id, :image_id)";
$stmt = $pdo->prepare($query);
$stmt->execute([
    ':prenom' => $prenom,
    ':species' => $species,
    ':details' => $details,
    ':habitat_id' => $habitat_id,
    ':image_id' => $image_id  // Assurez-vous que image_id est correctement géré
]);

header('Location: /arcadia/views/admin_gestion_animaux.php');
exit;

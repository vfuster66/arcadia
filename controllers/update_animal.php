<?php
require_once __DIR__ . '/../config/db.php';

$animal_id = $_POST['animal_id'];
$prenom = $_POST['prenom'];
$species = $_POST['species'];
$details = $_POST['details'];
$image_path = null;

if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
    $image_path = '/arcadia/public/images/animaux/' . basename($_FILES['photo']['name']);
    move_uploaded_file($_FILES['photo']['tmp_name'], __DIR__ . '/../public/images/animaux/' . basename($_FILES['photo']['name']));
}

// Mise à jour dans la base de données
$query = "UPDATE animal SET prenom = :prenom, species = :species, details = :details, image_id = :image_id WHERE animal_id = :animal_id";
$stmt = $pdo->prepare($query);
$stmt->execute([
    ':prenom' => $prenom,
    ':species' => $species,
    ':details' => $details,
    ':image_id' => $image_id,
    ':animal_id' => $animal_id
]);

header('Location: /arcadia/views/admin_gestion_animaux.php');
exit;

<?php
require_once __DIR__ . '/../config/db.php';

$animal_id = $_POST['animal_id'];

// Suppression de l'animal dans la base de données
$query = "DELETE FROM animal WHERE animal_id = :animal_id";
$stmt = $pdo->prepare($query);
$stmt->execute([':animal_id' => $animal_id]);

header('Location: /arcadia/views/admin_gestion_animaux.php');
exit;

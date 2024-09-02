<?php
require_once __DIR__ . '/../config/db.php';

$habitat_id = $_POST['habitat_id'];

// Supprimer l'habitat
$query = "DELETE FROM habitat WHERE habitat_id = :habitat_id";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':habitat_id', $habitat_id, PDO::PARAM_INT);
$stmt->execute();

// Supprimer les associations (si nécessaire)
// Vous pouvez également supprimer les images associées ou d'autres entités liées à cet habitat ici

// Redirection après la suppression
header('Location: /arcadia/views/admin_gestion_habitats.php');
exit();
?>